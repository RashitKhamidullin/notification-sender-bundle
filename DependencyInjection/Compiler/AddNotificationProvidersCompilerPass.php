<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 30.03.17
 * Time: 12:35
 */

namespace Brp\NotificationSenderBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddNotificationProvidersCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('brp_notification_sender')) {
            return;
        }

        $definition = $container->findDefinition('brp_notification_sender');

        $providerTaggedServices = $container->findTaggedServiceIds('brp_notification_sender_bundle.provider');

        foreach ($providerTaggedServices as $id => $tags) {
            $definition->addMethodCall('addProvider', array(new Reference($id)));
        }
    }
}