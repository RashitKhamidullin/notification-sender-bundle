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
     * Gets human readable name.
     *
     * @return string
     */
    public function getName();

    /**
     * Gets code for db.
     *
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
    public function getValue();
}
