<?php
namespace Brp\NotificationSenderBundle\Tests\Parameter;

use Brp\NotificationSenderBundle\Parameter\ArrayProviderParameter;

class ArrayProviderParameterTest extends \PHPUnit_Framework_TestCase
{
    /** @var ArrayProviderParameter $arrayParameter */
    private $arrayParameter;

    protected function setUp()
    {
        $this->arrayParameter = $this->createArrayParameter();
    }

    public function testArray()
    {
        $this->arrayParameter->setValue('param1, param2, param3');
        $this->arrayParameter->setParameters([]);

        $this->assertEquals(['param1', 'param2', 'param3'], $this->arrayParameter->getConvertedValue());
    }

    public function testArrayWithParams()
    {
        $this->arrayParameter->setValue('admin@mail.ru, {{EmailTo}}');
        $this->arrayParameter->setParameters(['EmailTo' => 'example@mail.org']);

        $this->assertEquals(['admin@mail.ru', 'example@mail.org'], $this->arrayParameter->getConvertedValue());
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

    public function testValueIsNotSet()
    {
        $this->setExpectedException(\Exception::class);

        $arrayParameter = $this->createArrayParameter();

        $arrayParameter->getConvertedValue();
    }

    public function testParamaterDoesNotExist()
    {
        $this->setExpectedException(\Exception::class, "The key param does't present in parameters");

        $arrayParameter = $this->createArrayParameter();
        $arrayParameter->setValue('{{param}}');
        $arrayParameter->setParameters(['dummy' => 'value']);
        $arrayParameter->getConvertedValue();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject | ArrayProviderParameter
     */
    protected function createArrayParameter()
    {
        return $this->getMockBuilder(ArrayProviderParameter::class)->getMockForAbstractClass();
    }
}
