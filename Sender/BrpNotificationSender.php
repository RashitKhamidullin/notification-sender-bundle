<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 11.04.17
 * Time: 11:01
 */

namespace Brp\NotificationSenderBundle\Sender;

use Brp\NotificationSenderBundle\Entity\NotificationTemplate;
use Brp\NotificationSenderBundle\Entity\NotificationTemplateParameter;
use Brp\NotificationSenderBundle\NotificationType\NotificationTypeInterface;
use Brp\NotificationSenderBundle\Parameter\ProviderConnectionParameterInterface;
use Brp\NotificationSenderBundle\Parameter\ProviderTemplateParameterInterface;
use Brp\NotificationSenderBundle\Provider\ProviderInterface;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

class BrpNotificationSender implements SenderInterface
{
    /** @var EntityManager $em */
    private $em;
    /** @var ProviderInterface[] $providers */
    private $providers;
    /** @var NotificationTypeInterface[] $notificationTypes */
    private $notificationTypes;
    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->providers = array();
        $this->logger = $logger;
    }

    /**
     * @param ProviderInterface $provider
     */
    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[$provider->getCode()] = $provider;
    }

    /**
     * @return array|\Brp\NotificationSenderBundle\Provider\ProviderInterface[]
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * @param NotificationTypeInterface $type
     */
    public function addNotificationType(NotificationTypeInterface $type)
    {
        $this->notificationTypes[$type->getCode()] = $type;
    }

    /**
     * @return \Brp\NotificationSenderBundle\NotificationType\NotificationTypeInterface[]
     */
    public function getNotificationTypes()
    {
        return $this->notificationTypes;
    }

    public function send(NotificationTypeInterface $notificationType)
    {
        $notificationTypeTemplates = $this->loadNotificationTypeTemplates($notificationType->getCode());

        /** @var NotificationTemplate $template */
        foreach ($notificationTypeTemplates as $template) {
            /** @var ProviderInterface $provider */
            $provider = $this->getProviderByCode($template->getProvider()->getCode());

            try {
                $this->fillProviderTemplateParams($provider, $template, $notificationType);

                $this->fillProviderConnectionParams($provider, $template);

                $availability = $provider->checkAvailable();

                if (true === $availability) {
                    $provider->send();
                } else {
                    $this->logger->error($availability);
                }

            } catch (\Exception $e) {
                $this->logger->error($e);
            }
        }
    }

    /**
     * @param $code
     *
     * @return mixed
     */
    protected function loadNotificationTypeTemplates($code)
    {
        return $this->em->getRepository(
            'BrpNotificationSenderBundle:NotificationTemplate'
        )->getNotificationTemplatesByCode($code);
    }

    public function getProviderByCode($providerCode)
    {
        if (array_key_exists($providerCode, $this->providers)) {
            return $this->providers[$providerCode];
        } else {
            throw new \Exception("Provider with code `$providerCode` does not exist");
        }
    }

    protected function loadProviderConnectionParams($provider)
    {
        return $provider->getParameters();
    }

    protected function fillProviderConnectionParams(ProviderInterface $provider, $template)
    {
        $providerConnectionStoredParams = $this->loadProviderConnectionParams($template->getProvider());
        /** @var ProviderConnectionParameterInterface $connectionParam */
        foreach ($provider->getConnectionParams() as $connectionParam) {
            if (array_key_exists($connectionParam->getCode(), $providerConnectionStoredParams)) {
                $param = $providerConnectionStoredParams[$connectionParam->getCode()];
                $connectionParam->setValue($param);
            } else {
                throw new \Exception("NotificationProviderParameter with code `$param` does not exist.");
            }
        }

    }

    protected function loadNotificationTemplateParams(NotificationTemplate $notificationTemplate)
    {
        return $notificationTemplate->getParameters();
    }

    protected function fillProviderTemplateParams(
        ProviderInterface $provider,
        NotificationTemplate $notificationTemplate,
        NotificationTypeInterface $notificationType)
    {
        $notificationTemplateParams = $this->loadNotificationTemplateParams($notificationTemplate);
        $providerParams = $provider->getTemplateParams();

        if (false === is_null($notificationTemplateParams)) {

            /** @var ProviderTemplateParameterInterface $param */
            foreach ($providerParams as $param) {
                if (array_key_exists($param->getCode(), $notificationTemplateParams)) {

                    $templateParameter = $notificationTemplateParams[$param->getCode()];

                    $param->setValue($templateParameter);
                    $param->setParameters($notificationType->getParams());

                } else {
                    throw new \Exception("NotificationTemplateParameter with code `$param->getCode()` does not exist");
                }
            }

        }
    }
}