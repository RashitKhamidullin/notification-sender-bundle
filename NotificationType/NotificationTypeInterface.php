<?php
/**
 * User: Rashit Khamidullin Rashit.Hamidullin@gmail.com
 * Date: 30.03.17
 * Time: 11:57
 *
 *
 */

namespace Brp\NotificationSenderBundle\NotificationType;

interface NotificationTypeInterface
{
    public function getName();

    public static function getCode();

    public function getDescription();

    /**
     * @return \Brp\NotificationSenderBundle\Parameter\ProviderConnectionParameterInterface[]
     */
    public function getParams();
}