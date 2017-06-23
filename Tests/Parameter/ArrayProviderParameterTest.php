<?php
namespace Brp\NotificationSenderBundle\Tests\Parameter;

use Brp\NotificationSenderBundle\Parameter\ArrayProviderParameter;

class ArrayProviderParameterTest extends \PHPUnit_Framework_TestCase
{
    /** @var ArrayProviderParameter $arrayParameter */
    private $arrayParameter;

    protected function setUp()
    {
        $this->arrayParameter = $this->getMockBuilder(ArrayProviderParameter::class)->getMockForAbstractClass();
    }

    public function testArray()
    {
        $this->arrayParameter->setValue('param1, param2, param3');
        $this->arrayParameter->setParameters([]);

        $this->assertEquals(['param1', 'param2', 'param3'], $this->arrayParameter->getConvertedValue());
    }

    public function testArrayWithParams()
    {
        $this->arrayParameter->setValue('{{EmailTo}}, admin@mail.ru');
        $this->arrayParameter->setParameters(['EmailTo' => 'example@mail.org']);

        $this->assertEquals(['example@mail.org', 'admin@mail.ru'], $this->arrayParameter->getConvertedValue());
    }

    public function testSingleValue()
    {
        $this->arrayParameter->setValue('param1');
        $this->arrayParameter->setParameters([]);

        $this->assertEquals(['param1'], $this->arrayParameter->getConvertedValue());
    }

    public function testEmptyValue()
    {
        $this->setExpectedException(\Exception::class);

        $this->arrayParameter->setValue('');
        $this->arrayParameter->setParameters([]);
        $this->arrayParameter->getConvertedValue();
    }

    public function testArrayParam()
    {
        $this->arrayParameter->setValue('{{param1}}, param2');
        $this->arrayParameter->setParameters(['param1' => ['val' => 'val2']]);
        $this->assertEquals([['val' => 'val2'], 'param2'], $this->arrayParameter->getConvertedValue());
    }
}
