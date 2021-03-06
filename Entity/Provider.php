<?php

namespace Brp\NotificationSenderBundle\Entity;

use Brp\NotificationSenderBundle\Entity\NotificationTemplate;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Provider
 *
 * @ORM\Table(name="brp_notification_provider")
 * @ORM\Entity(repositoryClass="Brp\NotificationSenderBundle\Repository\ProviderRepository")
 */
class Provider
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
     * @var
     * @ORM\Column(name="code", type="string")
     */
    private $code;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Brp\NotificationSenderBundle\Entity\NotificationTemplate", mappedBy="provider")
     */
    private $templates;

    /**
     * @var
     * @ORM\Column(name="parameters", type="json_array")
     */
    private $parameters;

    public function __construct()
    {
        $this->params = new ArrayCollection();
        $this->templates = new ArrayCollection();
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
     * @return Provider
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
     * @return Provider
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
     * Set code
     *
     * @param string $code
     * @return Provider
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add templates
     *
     * @param NotificationTemplate $templates
     * @return Provider
     */
    public function addTemplate(NotificationTemplate $templates)
    {
        $this->templates[] = $templates;

        return $this;
    }

    /**
     * Remove templates
     *
     * @param NotificationTemplate $templates
     */
    public function removeTemplate(NotificationTemplate $templates)
    {
        $this->templates->removeElement($templates);
    }

    /**
     * Get templates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTemplates()
    {
        return $this->templates;
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

    public function __toString()
    {
        return $this->getName();
    }
}
