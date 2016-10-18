<?php
declare(strict_types=1);

namespace WoohooLabs\Dicone\Builder;

use WoohooLabs\Dicone\Compiler\Compiler;
use WoohooLabs\Dicone\Compiler\CompilerConfig;
use WoohooLabs\Dicone\Compiler\DependencyResolver;
use WoohooLabs\Dicone\Definition\DefinitionInterface;

class ContainerBuilder
{
    /**
     * @param DefinitionInterface[] $definitions
     */
    public function build(string $filePath, string $namespace, string $className, array $definitions)
    {
        $definitionHints = [];
        foreach ($definitions as $definition) {
            $definitionHints = array_merge($definitionHints, $definition->getDefinitionHints());
        }

        $dependencyResolver = new DependencyResolver(new CompilerConfig(true, true), $definitionHints);

        foreach ($definitions as $definition) {
            foreach ($definition->getEntryPoints() as $entryPoint) {
                foreach ($entryPoint->getClassNames() as $entryPointClassName) {
                    $dependencyResolver->resolve($entryPointClassName);
                }
            }
        }

        $compiler = new Compiler();
        $container = $compiler->compileDefinitions($namespace, $className, $dependencyResolver->getDefinitionItems());
        file_put_contents($filePath, $container);
    }
}
