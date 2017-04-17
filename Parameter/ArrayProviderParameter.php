<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 11.04.17
 * Time: 12:46
 */

namespace Brp\NotificationSenderBundle\Parameter;

abstract class ArrayProviderParameter implements ProviderTemplateParameterInterface
{
    protected $renderedValue;
    protected $value;

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getConvertedValue()
    {
        return $this->renderedValue;
    }

    public function setRenderedValueWith($parameters)
    {
        $this->renderedValue = $this->convert($parameters);
    }

    protected function convert($parameters)
    {
        $result = [];

        $arr = explode(',', $this->value);

//        preg_match_all('/\{\%\s*(.*)\s*\%\}|\{\{(?!%)\s*((?:[^\s])*)\s*(?<!%)\}\}/i', $str, $matches);

        foreach ($arr as $a) {
            $k = str_replace(['{{', '}}'], '', $a);
            if (array_key_exists($k, $parameters)) {
                $result = $parameters[$k];
            } else {
                $result[] = trim($k);
            }
        }

        if (count($result) > 0) {
            return $result;
        } else {
            throw new \Exception("Wrong convert params");
        }
    }
}