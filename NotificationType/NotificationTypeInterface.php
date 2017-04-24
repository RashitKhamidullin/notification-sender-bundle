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
    /**
     * Gets name;
     *
     * @return string
     */
    public function getName();

    /**
     * Get code for db.
     *
     * @return string
     */
    public function getCode();

    /**
     * Get human readable description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Gets params.
     *
     * @return \Brp\NotificationSenderBundle\Parameter\ProviderConnectionParameterInterface[]
     */
    public function getParams();

    /**
     * Generates proper notification information from data.
     *
     * @param $data
     *
     * @return mixed
     * @throws \Exception
     */
    public function generateNotification($data);
}