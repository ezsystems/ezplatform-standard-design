<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzPlatformStandardDesignBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generate Configuration for eZ Platform Standard Design.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ez_platform_standard_design');

        $rootNode
            ->children()
                ->booleanNode('override_kernel_templates')
                    ->defaultFalse()
                    ->info('Enable this to prepend Kernel default template paths with @ezdesign namespace')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
