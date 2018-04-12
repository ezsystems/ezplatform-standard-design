<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzPlatformStandardDesignBundle;

use EzSystems\EzPlatformStandardDesignBundle\DependencyInjection\Compiler\EzKernelOverridePass;
use EzSystems\EzPlatformStandardDesignBundle\DependencyInjection\Compiler\StandardThemePass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * eZ Platform Standard Design Bundle.
 */
class EzPlatformStandardDesignBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // Ensure compiler passes are processed before eZ Design Engine passes, by giving priority > 0
        $container->addCompilerPass(new EzKernelOverridePass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);
        $container->addCompilerPass(new StandardThemePass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);
    }
}
