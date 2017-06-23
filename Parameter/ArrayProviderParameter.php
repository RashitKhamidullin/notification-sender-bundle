<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 11.04.17
 * Time: 12:46
 */

namespace Brp\NotificationSenderBundle\Parameter;

abstract class ArrayProviderParameter implements ProviderTemplateParameterInterface
{
    protected $value;
    protected $parameters;

    public function setValue($value)
    {
        $this->value = (string)$value;
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
        $result = [];

        if (false === is_null($this->value) && strlen($this->value) > 0) {

            $arr = explode(',', $this->value);

            foreach ($arr as $a) {
                $k = str_replace(['{{', '}}'], '', $a);
                if (array_key_exists($k, $parameters)) {
                    $result[] = $parameters[$k];
                } else {
                    $result[] = trim($k);
                }
            }

            return $result;
        }

        throw new \Exception("Provider Template Parameter is wrong");
    }
}