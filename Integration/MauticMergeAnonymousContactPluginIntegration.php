<?php

namespace MauticPlugin\MauticMergeAnonymousContactPluginBundle\Integration;

use Mautic\IntegrationsBundle\Integration\BasicIntegration;
use Mautic\IntegrationsBundle\Integration\ConfigurationTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\BasicInterface;

class MauticMergeAnonymousContactPluginIntegration extends BasicIntegration implements BasicInterface
{
    use ConfigurationTrait;

    public const INTEGRATION_NAME = 'mauticmergeanonymouscontactplugin';
    public const DISPLAY_NAME     = 'Mautic Merge Anonymous Contact Plugin';

    public function getName(): string
    {
        return self::INTEGRATION_NAME;
    }

    public function getDisplayName(): string
    {
        return self::DISPLAY_NAME;
    }

    public function getIcon(): string
    {
        return 'plugins/MauticMergeAnonymousContactPluginBundle/Assets/img/icon.png';
    }
}
