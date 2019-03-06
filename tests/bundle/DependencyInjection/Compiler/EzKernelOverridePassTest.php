<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\Tests\EzPlatformStandardDesignBundle\DependencyInjection\Compiler;

use EzSystems\EzPlatformStandardDesignBundle\DependencyInjection\Compiler\EzKernelOverridePass;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Test overriding eZ Kernel setup for templates with eZ Design.
 *
 * @see \EzSystems\EzPlatformStandardDesignBundle\DependencyInjection\Compiler\EzKernelOverridePass
 */
class EzKernelOverridePassTest extends AbstractCompilerPassTestCase
{
    public function getTemplatesPathMap()
    {
        return [
            [[]],
            [['standard' => ['/other/path']]],
            [['custom' => ['/another/path']]],
        ];
    }

    /**
     * Register the StandardTheme compiler pass under test.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $container->setParameter('ez_platform_standard_design.override_kernel_templates', true);

        $container->addCompilerPass(new EzKernelOverridePass());
    }

    /**
     * @dataProvider getTemplatesPathMap
     *
     * @param array $templatesPathMap
     */
    public function testKernelViewsDirectoryIsMappedToStandardTheme(array $templatesPathMap)
    {
        $this->setParameter('ezdesign.templates_path_map', $templatesPathMap);
        $this->setParameter(
            'kernel.bundles_metadata',
            [
                'EzPublishCoreBundle' => [
                    'path' => '/some/path',
                ],
            ]
        );

        $this->container->compile();

        $templatesPathMap['standard'][] = '/some/path/Resources/views';

        self::assertContainerBuilderHasParameter(
            'ezdesign.templates_path_map',
            $templatesPathMap
        );
    }

    public function testKernelTemplateNamesHaveEzDesignPrefix()
    {
        $this->container->compile();

        $parameters = $this->container->getParameterBag()->all();
        foreach ($parameters as $parameterId => $parameterValue) {
            $templates = [];

            if (is_string($parameterValue)) {
                $templates[] = $parameterValue;
            } elseif (is_array($parameterValue)) {
                foreach ($parameterValue as $nestedValues) {
                    if (!isset($nestedValues['template'])) {
                        continue;
                    }
                    $templates[] = $nestedValues['template'];
                }
            }

            foreach ($templates as $templatePath) {
                self::assertStringStartsWith(
                    '@ezdesign/',
                    $templatePath,
                    "Parameter '{$parameterId}' template(s) doesn't start with '@ezdesign' prefix"
                );
            }
        }
    }
}
