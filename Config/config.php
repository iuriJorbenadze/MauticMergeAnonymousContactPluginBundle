<?php
return [
    'name'        => 'Lenon Leite',
    'description' => 'This plugin is simple example of plugin to Mautic 5',
    'version'     => '1.0.0',
    'author'      => 'Lenon Leite',
    'services'    => [
        'integrations' => [
            'mautic.integration.lenonleitem5exampleplugin' => [
                'class' => \MauticPlugin\LenonLeiteM5ExamplePluginBundle\Integration\LenonLeiteM5ExamplePluginIntegration::class,
                'tags'  => [
                    'mautic.integration',
                    'mautic.basic_integration',
                ],
            ],
            'mautic.integration.lenonleitem5exampleplugin.configuration' => [
                'class' => \MauticPlugin\LenonLeiteM5ExamplePluginBundle\Integration\Support\ConfigSupport::class,
                'tags'  => [
                    'mautic.config_integration',
                ],
            ],
            'mautic.integration.lenonleitem5exampleplugin.config' => [
                'class' => \MauticPlugin\LenonLeiteM5ExamplePluginBundle\Integration\Config::class,
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
