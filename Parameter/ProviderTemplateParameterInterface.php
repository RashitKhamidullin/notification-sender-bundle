<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 12.04.17
 * Time: 14:12
 */

namespace Brp\NotificationSenderBundle\Parameter;

interface ProviderTemplateParameterInterface
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

    public function getConvertedValue();

    public function setRenderedValueWith($parameters);
}