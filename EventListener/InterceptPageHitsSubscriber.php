<?php

namespace MauticPlugin\MauticMergeAnonymousContactPluginBundle\EventListener;

use Mautic\PageBundle\PageEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Mautic\PageBundle\Event as Events;
use Mautic\LeadBundle\Model\LeadModel;
use Doctrine\ORM\EntityManagerInterface;

class InterceptPageHitsSubscriber implements EventSubscriberInterface
{
    private LeadModel $leadModel;
    private EntityManagerInterface $entityManager;

    public function __construct(LeadModel $leadModel, EntityManagerInterface $entityManager)
    {
        $this->leadModel = $leadModel;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            PageEvents::PAGE_ON_HIT => ['onPageHit', 0],
        ];
    }

    /**
     * Trigger point actions for page hits.
     */
    public function onPageHit(Events\PageHitEvent $event): void
    {
        $request = $event->getRequest();
        $cookies = $request->cookies;

        // Hit
        $hit = $event->getHit();
        $trackingId = $hit->getTrackingId();

        // Get the contact from the hit
        $lead = $hit->getLead();
        if (!$lead) {
            // No contact associated with this hit, nothing to do
            return;
        }

        // If a cookie exists, capture the old contact ID
        if ($cookies->has('mtc_id')) {
            $oldContactId = $cookies->get('mtc_id');

            // If the cookie is about to be overridden (new lead ID differs from old ID)
            if ($oldContactId !== $lead->getId()) {
                // Merge the old contact into the new contact
                $this->mergeContacts($lead->getId(), $oldContactId);
            }
        }
    }

    /**
     * Fetch a contact by ID using Mautic's internal services.
     */
    private function getContactById(string $contactId)
    {
        return $this->leadModel->getEntity($contactId);
    }

    /**
     * Simulate merging one contact into another.
     *
     * @param string $targetContactId ID of the contact to merge into
     * @param string $sourceContactId ID of the contact being merged
     */
    private function mergeContacts(string $targetContactId, string $sourceContactId): void
    {
        $targetContact = $this->getContactById($targetContactId);
        $sourceContact = $this->getContactById($sourceContactId);

        if ($targetContact && $sourceContact) {
            // 1) Reassign page hits (existing logic, unchanged)
            $this->entityManager->createQueryBuilder()
                ->update(\Mautic\PageBundle\Entity\Hit::class, 'ph')
                ->set('ph.lead', ':newLead')
                ->where('ph.lead = :oldLead')
                ->setParameter('newLead', $targetContact->getId())
                ->setParameter('oldLead', $sourceContact->getId())
                ->getQuery()
                ->execute();

            // 2) Merge IPs (existing logic, unchanged)
            foreach ($sourceContact->getIpAddresses() as $ipAddress) {
                $targetContact->addIpAddress($ipAddress);
            }

            // 3) Merge fields (new logic)
            $this->mergeFields($sourceContact, $targetContact);

            // 4) Persist the updated contact (existing logic, unchanged)
            $this->entityManager->persist($targetContact);

            // 5) Optionally delete the old contact (existing logic, unchanged)
            // $this->leadModel->deleteEntity($sourceContact);

            // 6) Save changes (existing logic, unchanged)
            $this->entityManager->flush();
        }
    }

// Merge fields from source to target contact
    private function mergeFields($sourceContact, $targetContact): void
    {
        // 1) Retrieve all fields (standard and custom) from the database
        $fields = $this->entityManager
            ->getRepository(\Mautic\LeadBundle\Entity\LeadField::class)
            ->findAll();

        // 2) Prepare the values to update
        $values = [];
        foreach ($fields as $field) {
            $fieldAlias = $field->getAlias(); // Get the field alias (e.g., 'email', 'phone', or custom field alias)

            // Fetch values from both source and target
            $sourceValue = $sourceContact->getFieldValue($fieldAlias);
            $targetValue = $targetContact->getFieldValue($fieldAlias);

            // Only copy if the source has a value and the target doesn't
            if (!empty($sourceValue) && empty($targetValue)) {
                $values[$fieldAlias] = $sourceValue;
            }
        }

        // 3) Use setFieldValues to update target contact fields
        $this->leadModel->setFieldValues($targetContact, $values, false, false);

        // Persist changes in the database (optional, depends on context)
        $this->leadModel->saveEntity($targetContact);
    }




}
