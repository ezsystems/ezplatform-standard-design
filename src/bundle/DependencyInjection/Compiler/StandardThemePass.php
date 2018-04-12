<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzPlatformStandardDesignBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Ensure Standard theme is a fallback of every design.
 */
class StandardThemePass implements CompilerPassInterface
{
    /**
     * Process defined designs and themes list and append standard theme if missing.
     *
     * Standard theme defines default core templates used for rendering, so when different design
     * is used, missing template still needs to be rendered using fallback.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasParameter('ezdesign.design_list')) {
            return;
        }

        $designList = $container->getParameter('ezdesign.design_list');
        foreach ($designList as $designName => $themes) {
            if (!in_array('standard', $themes)) {
                $designList[$designName][] = 'standard';
            }
        }
        $container->setParameter('ezdesign.design_list', $designList);
    }
}
