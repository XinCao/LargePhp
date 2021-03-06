<?php

namespace DreamHeaven\AdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface {

    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dreamheaven_admin');

//        $rootNode
//            ->children()
//                ->arrayNode('provider')
//                    ->children()
//                        ->scalarNode('name')->defaultValue('solr')->end()
//                    ->end()
//                ->end()
//            ->end();

        return $treeBuilder;
    }

}