<?php

namespace Brp\NotificationSenderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationTemplateParameter
 *
 * @ORM\Table(name="brp_notification_template_parameter")
 * @ORM\Entity(repositoryClass="Brp\NotificationSenderBundle\Repository\NotificationTemplateParameterRepository")
 */
class NotificationTemplateParameter
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
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Brp\NotificationSenderBundle\Entity\NotificationTemplate", inversedBy="params")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $template;

    /**
     * @var
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

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
     * @return NotificationTemplateParameter
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
     * @return NotificationTemplateParameter
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
     * Set template
     *
     * @param NotificationTemplate $template
     * @return NotificationTemplateParameter
     */
    public function setTemplate(NotificationTemplate $template = null)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return NotificationTemplate
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return NotificationTemplateParameter
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

    public function __toString()
    {
        return $this->getCode();
    }
}
