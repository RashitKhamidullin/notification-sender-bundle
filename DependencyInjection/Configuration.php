<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 30.03.17
 * Time: 12:22
 */

namespace Brp\NotificationSenderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $treeBuilder->root('brp_notification_sender')
            ->children()
            ->scalarNode('entity_manager')
            ->isRequired()
            ->cannotBeEmpty()
            ->info('Name of doctrine entity manager')
            ->end()
        ;

        return $treeBuilder;
    }
}