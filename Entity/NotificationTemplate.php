<?php

namespace Brp\NotificationSenderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationTemplate
 *
 * @ORM\Table(name="brp_notification_template")
 * @ORM\Entity(repositoryClass="Brp\NotificationSenderBundle\Repository\NotificationTemplateRepository")
 */
class NotificationTemplate
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var
     * @ORM\Column(name="notification_code", type="string")
     */
    private $notificationCode;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Brp\NotificationSenderBundle\Entity\NotificationTemplateParameter", mappedBy="template", cascade={"remove", "persist"})
     */
    private $params;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Brp\NotificationSenderBundle\Entity\Provider", inversedBy="templates")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id")
     */
    private $provider;

    /**
     * @var
     * @ORM\Column(name="parameters", type="json")
     */
    private $parameters;

    public function __construct()
    {
        $this->params = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return NotificationTemplate
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return NotificationTemplate
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return NotificationTemplate
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add params
     *
     * @param NotificationTemplateParameter $params
     * @return NotificationTemplate
     */
    public function addParam(NotificationTemplateParameter $params)
    {
        $this->params[] = $params;

        return $this;
    }

    /**
     * Remove params
     *
     * @param NotificationTemplateParameter $params
     */
    public function removeParam(NotificationTemplateParameter $params)
    {
        $this->params->removeElement($params);
    }

    /**
     * Get params
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set code
     *
     * @param $notificationCode
     *
     * @return NotificationTemplate
     */
    public function setNotificationCode($notificationCode)
    {
        $this->notificationCode = $notificationCode;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getNotificationCode()
    {
        return $this->notificationCode;
    }

    /**
     * Set provider
     *
     * @param Provider $provider
     * @return NotificationTemplate
     */
    public function setProvider(Provider $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    public function __toString()
    {
        return is_null($this->getName()) ? 'New Notification Template' : $this->getName();
    }

    /**
     * Set parameters
     *
     * @param json $parameters
     * @return NotificationTemplate
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Get parameters
     *
     * @return json 
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
