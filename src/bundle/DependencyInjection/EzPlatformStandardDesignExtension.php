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
        // Nothing to load so far
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
