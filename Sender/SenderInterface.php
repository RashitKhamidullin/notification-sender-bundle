<?php
/**
 * User: Rashit Hamidullin Rashit.Hamidullin@gmail.com
 * Date: 29.03.17
 * Time: 17:10
 *
 *
 */
namespace Brp\NotificationSenderBundle\Sender;

use Brp\NotificationSenderBundle\NotificationType\NotificationTypeInterface;

interface SenderInterface
{
    public function send(NotificationTypeInterface $code);
}