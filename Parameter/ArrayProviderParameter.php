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
    protected $parameters = array();

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
        if (true === is_null($this->value)) {
            throw new \Exception("Value must be set before");
        }

        $result = [];

        if (false === is_null($this->value) && strlen($this->value) > 0) {

            $arr = explode(',', $this->value);

            foreach ($arr as $a) {
                $a = trim($a);
                if (substr($a, 0, 2) === '{{' && substr($a, -2) === '}}') {

                    $k = str_replace(['{{', '}}'], '', $a);

                    if (array_key_exists($k, $parameters)) {
                        $result[] = $parameters[$k];
                    } else {
                        throw new \Exception(sprintf("The key %s does't present in parameters", $k));
                    }

                } else {
                    $result[] = $a;
                }
            }

            return $result;
        }

        throw new \Exception("Provider Template Parameter is wrong");
    }
}