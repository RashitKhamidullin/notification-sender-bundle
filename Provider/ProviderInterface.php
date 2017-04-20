<?php
/**
 * User: Rashit Hamidullin Rashit.Hamidullin@gmail.com
 * Date: 30.03.17
 * Time: 11:32
 *
 *
 */

namespace Brp\NotificationSenderBundle\Provider;

use Brp\NotificationSenderBundle\Parameter\ProviderConnectionParameterInterface;
use Brp\NotificationSenderBundle\Parameter\ProviderTemplateParameterInterface;

interface ProviderInterface
{
    /**
     * Sends message
     */
    public function send();

    /**
     * @return ProviderConnectionParameterInterface[]
     */
    public function getConnectionParams();

    /**
     * @return ProviderTemplateParameterInterface[]
     */
    public function getTemplateParams();

    /**
     * @param $code
     *
     * @return ProviderTemplateParameterInterface
     */
    public function getTemplateParamsByCode($code);

    /**
     * @return mixed
     */
    public function checkAvailable();

    /**
     * Gets code for db
     *
     * @return string
     */
    public function getCode();

    /**
     * Gets human readable string.
     *
     * @return string
     */
    public function getDescription();
}