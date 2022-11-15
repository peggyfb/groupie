<?php

namespace App\Bundle\RoleBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('amu_role');
        $rootNode
            ->children()
                ->arrayNode('rules')
                ->isRequired()
                ->requiresAtLeastOneElement()
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('type')->isRequired()->cannotBeEmpty()
                                ->validate()
                                ->ifNotInArray(array('ldap', 'group', 'login', 'ip'))
                                ->thenInvalid('%s is not a valid type ["ldap","group","login","ip"].')
                                ->end()
                            ->end()
                            ->variableNode('rule')->isRequired()->cannotBeEmpty()->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('amu_ldap')
                    ->children()
                        ->scalarNode('default_profil')
                            ->defaultValue('default')
                        ->end()
                        ->arrayNode('profils')
                        ->isRequired()
                        ->requiresAtLeastOneElement()
                            ->prototype('array')
                                ->children()
                                    ->arrayNode('servers')
                                    ->isRequired()
                                    ->requiresAtLeastOneElement()
                                        ->prototype('array')
                                            ->children()
                                                ->scalarNode('host')->isRequired()->end()
                                                ->integerNode('port')->isRequired()->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->scalarNode('relative_dn')->isRequired()->end()
                                    ->scalarNode('password')->isRequired()->end()
                                    ->scalarNode('base_dn')->defaultValue('ou=people,dc=univ-amu,dc=fr')->end()
                                    ->integerNode('network_timeout')->isRequired()->end()
                                    ->integerNode('protocol_version')->isRequired()->end()
                                    ->integerNode('referrals')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

    public function addParametersNode()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('amu_ldap');

        $node
            ->children()
            ->scalarNode('default_profil')
            ->defaultValue('default')
            ->end()
            ->arrayNode('profils')
            ->isRequired()
            ->requiresAtLeastOneElement()
            ->prototype('array')
            ->children()
            ->arrayNode('servers')
            ->isRequired()
            ->requiresAtLeastOneElement()
            ->prototype('array')
            ->children()
            ->scalarNode('host')->isRequired()->end()
            ->integerNode('port')->isRequired()->end()
            ->end()
            ->end()
            ->end()
            ->scalarNode('relative_dn')->isRequired()->end()
            ->scalarNode('password')->isRequired()->end()
            ->scalarNode('base_dn')->defaultValue('ou=people,dc=univ-amu,dc=fr')->end()
            ->integerNode('network_timeout')->isRequired()->end()
            ->integerNode('protocol_version')->isRequired()->end()
            ->integerNode('referrals')->end()
            ->end()
            ->end()
            ->end();

        return $node;
    }
}
