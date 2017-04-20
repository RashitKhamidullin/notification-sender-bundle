<?php
/**
 * User: Rashit Hamidullin Rashit.Hamidullin@gmail.com
 * Date: 30.03.17
 * Time: 11:32
 *
 *
 */

namespace Brp\NotificationSenderBundle\Provider;

interface ProviderInterface
{
    public function send();

    public function getConnectionParams();

    public function getTemplateParams();

    public function getTemplateParamsByCode($code);

    public function checkAvailable();

    public function getCode();

    public function getDescription();
}