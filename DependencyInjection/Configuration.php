<?php
/**
 * This file is part of the PrestaCMSSocialBundle
 *
 * (c) PrestaConcept <www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('presta_cms_social');

        $rootNode
            ->children()
                ->arrayNode('twitter')
                    ->children()
                        ->scalarNode('url')->end()
                        ->scalarNode('consumer_key')->end()
                        ->scalarNode('consumer_secret')->end()
                        ->scalarNode('token')->end()
                        ->scalarNode('token_secret')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
