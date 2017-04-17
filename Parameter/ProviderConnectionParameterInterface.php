<?php
/**
 * User: Rashit Khamidullin Rashit.Khamidullin@gmail.com
 * Date: 30.03.17
 * Time: 11:18
 */

namespace Brp\NotificationSenderBundle\Parameter;

interface ProviderConnectionParameterInterface
{
    /**
     * Human readable name
     * @return string
     */
    public function getName();

    /**
     * Unique code for db search
     * @return string
     */
    public function getCode();

    /**
     * @return string
     */
    public function getType();

    public function setValue($value);

    public function getValue();
}
