<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 30.03.17
 * Time: 12:32
 */

namespace Brp\NotificationSenderBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddNotificationTypesCompilerPass implements CompilerPassInterface
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

        $typeTaggedServices = $container->findTaggedServiceIds('brp_notification_sender_bundle.type');

        foreach ($typeTaggedServices as $id => $tags) {
            $definition->addMethodCall('addNotificationType', array(new Reference($id)));
        }
    }
}