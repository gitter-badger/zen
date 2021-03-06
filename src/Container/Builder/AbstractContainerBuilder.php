<?php
declare(strict_types=1);

namespace WoohooLabs\Zen\Container\Builder;

use WoohooLabs\Zen\Config\AbstractCompilerConfig;
use WoohooLabs\Zen\Container\Compiler;
use WoohooLabs\Zen\Container\DependencyResolver;

abstract class AbstractContainerBuilder
{
    protected function getContainer(AbstractCompilerConfig $compilerConfig)
    {
        $definitionHints = [];
        foreach ($compilerConfig->getContainerConfigs() as $containerConfig) {
            $definitionHints = array_merge($definitionHints, $containerConfig->createDefinitionHints());
        }

        $dependencyResolver = new DependencyResolver($compilerConfig, $definitionHints);
        $dependencyResolver->resolveEntryPoints();

        $compiler = new Compiler();

        return $compiler->compile($compilerConfig, $dependencyResolver->getDefinitions());
    }
}
