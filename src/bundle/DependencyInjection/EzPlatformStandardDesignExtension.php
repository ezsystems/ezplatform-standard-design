<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzPlatformStandardDesignBundle\DependencyInjection;

use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\Yaml\Yaml;

class EzPlatformStandardDesignExtension extends Extension implements PrependExtensionInterface
{
    const OVERRIDE_KERNEL_TEMPLATES_PARAM_NAME = 'ez_platform_standard_design.override_kernel_templates';

    /**
     * Load Bundle Configuration.
     *
     * @param array $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter(
            static::OVERRIDE_KERNEL_TEMPLATES_PARAM_NAME,
            $config['override_kernel_templates']
        );
    }

    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function prepend(ContainerBuilder $container)
    {
        $this->prependEzDesignSettings($container);
    }

    /**
     * Prepend settings for the given external extension.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $containerBuilder
     */
    private function prependEzDesignSettings(ContainerBuilder $containerBuilder)
    {
        $configFile = __DIR__ . '/../Resources/config/extension/ezdesign.yaml';
        $config = Yaml::parseFile($configFile);
        $containerBuilder->prependExtensionConfig('ezdesign', $config);
        $containerBuilder->addResource(new FileResource($configFile));
    }
}
