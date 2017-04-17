<?php
namespace Brp\NotificationSenderBundle;

use Brp\NotificationSenderBundle\DependencyInjection\Compiler\AddNotificationProvidersCompilerPass;
use Brp\NotificationSenderBundle\DependencyInjection\Compiler\AddNotificationTypesCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BrpNotificationSenderBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddNotificationProvidersCompilerPass());
        $container->addCompilerPass(new AddNotificationTypesCompilerPass());
    }
}