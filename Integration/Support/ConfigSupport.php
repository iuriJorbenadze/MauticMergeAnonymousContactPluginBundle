<?php

declare(strict_types=1);

namespace MauticPlugin\MauticMergeAnonymousContactPluginBundle\Integration\Support;

use Mautic\IntegrationsBundle\Integration\DefaultConfigFormTrait;
use Mautic\IntegrationsBundle\Integration\Interfaces\ConfigFormInterface;
use MauticPlugin\MauticMergeAnonymousContactPluginBundle\Integration\MauticMergeAnonymousContactPluginIntegration;

class ConfigSupport extends MauticMergeAnonymousContactPluginIntegration implements ConfigFormInterface
{
    use DefaultConfigFormTrait;
}
