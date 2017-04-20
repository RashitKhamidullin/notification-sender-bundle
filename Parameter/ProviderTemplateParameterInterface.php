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
     * Gets human readable name.
     *
     * @return string
     */
    public function getName();

    /**
     * Gets code for db.
     * @return string
     */
    public function getCode();

    /**
     * Gets type.
     *
     * @return string
     */
    public function getType();

    /**
     * Sets value.
     *
     * @param $value
     * @return void
     */
    public function setValue($value);

    /**
     * Gets value.
     *
     * @return mixed
     */
    public function getConvertedValue();

    public function setRenderedValueWith($parameters);
}