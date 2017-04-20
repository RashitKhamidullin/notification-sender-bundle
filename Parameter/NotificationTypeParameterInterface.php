<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 11.04.17
 * Time: 19:14
 */

namespace Brp\NotificationSenderBundle\Parameter;


interface NotificationTypeParameterInterface
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
    public static function getCode();

    /**
     * Gets type of the parameter
     * @return string
     */
    public function getType();
}