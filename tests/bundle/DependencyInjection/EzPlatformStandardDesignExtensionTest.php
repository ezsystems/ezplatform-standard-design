<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\Tests\EzPlatformStandardDesignBundle\DependencyInjection;

use EzSystems\EzPlatformStandardDesignBundle\DependencyInjection\EzPlatformStandardDesignExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

class EzPlatformStandardDesignExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return [
            new EzPlatformStandardDesignExtension(),
        ];
    }

    public function testExtensionPrependsStandardDesignSettings()
    {
        $this->load();

        self::assertContains(
            [
                'design_list' => [
                    'standard' => ['standard'],
                ],
            ],
            $this->container->getExtensionConfig('ezdesign')
        );
    }
}
