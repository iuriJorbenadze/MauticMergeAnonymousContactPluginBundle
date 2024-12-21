<?php
return [
    'name'        => 'Mautic Merge Anonymous Contact Plugin',
    'description' => 'Automatically merges anonymous contacts with identified contacts in Mautic.',
    'version'     => '1.0.0',
    'author'      => 'Your Name',
    'services'    => [
        'integrations' => [
            'mautic.integration.mauticmergeanonymouscontactplugin' => [
                'class' => \MauticPlugin\MauticMergeAnonymousContactPluginBundle\Integration\MauticMergeAnonymousContactPluginIntegration::class,
                'tags'  => [
                    'mautic.integration',
                    'mautic.basic_integration',
                ],
            ],
            'mautic.integration.mauticmergeanonymouscontactplugin.configuration' => [
                'class' => \MauticPlugin\MauticMergeAnonymousContactPluginBundle\Integration\Support\ConfigSupport::class,
                'tags'  => [
                    'mautic.config_integration',
                ],
            ],
            'mautic.integration.mauticmergeanonymouscontactplugin.config' => [
                'class' => \MauticPlugin\MauticMergeAnonymousContactPluginBundle\Integration\Config::class,
                'tags'  => [
                    'mautic.integrations.helper',
                ],
                'arguments' => [
                    'mautic.integrations.helper',
                ],
            ],
        ],
    ],
];
