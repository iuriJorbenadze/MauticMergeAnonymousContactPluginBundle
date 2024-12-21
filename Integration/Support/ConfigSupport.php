<?php

declare(strict_types=1);

namespace MauticPlugin\LenonLeiteM5ExamplePluginBundle\Integration\Support;

use Mautic\IntegrationsBundle\Integration\DefaultConfigFormTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormInterface;
use MauticPlugin\LenonLeiteM5ExamplePluginBundle\Integration\LenonLeiteM5ExamplePluginIntegration;

class ConfigSupport extends LenonLeiteM5ExamplePluginIntegration implements ConfigFormInterface
{
    use DefaultConfigFormTrait;
}
