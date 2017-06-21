<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 11.04.17
 * Time: 12:47
 */

namespace Brp\NotificationSenderBundle\Parameter;

abstract class StringProviderParameter implements ProviderTemplateParameterInterface
{
    /** @var \Twig_Environment $twig */
    protected $twig;
    protected $value;
    protected $parameters;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getConvertedValue()
    {
        return $this->convert($this->parameters);
    }

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    protected function convert($parameters)
    {
        $twigTemplate = $this->twig->createTemplate($this->value);

        return $twigTemplate->render($parameters);
    }

}