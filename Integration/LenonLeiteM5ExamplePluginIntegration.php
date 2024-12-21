<?php
declare(strict_types=1);

namespace MauticPlugin\LenonLeiteM5ExamplePluginBundle\Integration;

use Mautic\IntegrationsBundle\Integration\BasicIntegration;
use Mautic\IntegrationsBundle\Integration\ConfigurationTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\BasicInterface;

class LenonLeiteM5ExamplePluginIntegration extends BasicIntegration implements BasicInterface
{
    use ConfigurationTrait;

    public const INTEGRATION_NAME = 'lenonleitem5exampleplugin';
    public const DISPLAY_NAME     = 'Example of plugin to Mautic 5';

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
        return 'plugins/LenonLeiteM5ExamplePluginBundle/Assets/img/icon.png';
    }
}