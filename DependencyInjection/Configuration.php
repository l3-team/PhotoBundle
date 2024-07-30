<?php

namespace L3\Bundle\PhotoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('l3_photo');
        $rootNode = $treeBuilder->getRootNode();

        
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
                ->children()
                        ->arrayNode('photo')
                                ->children()
                                        ->scalarNode('enabled')->isRequired()->cannotBeEmpty()->end()
                                        ->scalarNode('image_url')->isRequired()->cannotBeEmpty()->end()
                                        ->scalarNode('token_url')->isRequired()->cannotBeEmpty()->end()
                                ->end()
                                ->validate()
                                        ->ifTrue(function($config) { return is_bool($config['enabled']) && filter_var($config['image_url'], FILTER_VALIDATE_URL) && filter_var($config['token_url'], FILTER_VALIDATE_URL); })
                                                ->thenInvalid('Error configuration photo')
                                        ->end()
                        ->end()
                    ->end()
		->end();
                                        
        return $treeBuilder;
    }
}
