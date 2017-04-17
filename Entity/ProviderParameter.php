<?php

namespace Brp\NotificationSenderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProviderParam
 *
 * @ORM\Table(name="brp_notification_provider_parameter")
 * @ORM\Entity(repositoryClass="Brp\NotificationSenderBundle\Repository\ProviderParameterRepository")
 */
class ProviderParameter
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
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Brp\NotificationSenderBundle\Entity\Provider", inversedBy="params")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $provider;

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
     * @return ProviderParam
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
     * Set value
     *
     * @param string $value
     * @return ProviderParam
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set provider
     *
     * @param Provider $provider
     * @return ProviderParameter
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

    /**
     * Set code
     *
     * @param string $code
     *
     * @return ProviderParameter
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
}
