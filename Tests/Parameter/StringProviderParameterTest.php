<?php
/**
 * User: Rashit Khamidullin Rashit.Kamidullin@gmail.com
 * Date: 23.06.17
 * Time: 12:25
 */

namespace Brp\NotificationSenderBundle\Tests\Parameter;

use Brp\NotificationSenderBundle\Parameter\StringProviderParameter;

class StringProviderParameterTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Twig_Environment|\PHPUnit_Framework_MockObject_MockObject $twig */
    private $twig;
    /** @var Twig_TemplateInterface | \PHPUnit_Framework_MockObject_MockObject $twigTemplate */
    private $twigTemplate;

    public function setUp()
    {
        $this->twig = $this->getMockBuilder(\Twig_Environment::class)->getMock();

        $this->twigTemplate = $this->getMockBuilder(\Twig_TemplateInterface::class)->getMock();

        $this->twig->method('createTemplate')->willReturn($this->twigTemplate);
    }

    public function testConvert()
    {
        $params = ['param1', 'param2'];
        $value = 'value';

        /** @var StringProviderParameter|\PHPUnit_Framework_MockObject_MockObject $stringParameter */
        $stringParameter = $this->createStringParameter();

        $stringParameter->setParameters($params);
        $stringParameter->setValue($value);

        $this->twig->expects($this->once())->method('createTemplate')->with($value);
        $this->twigTemplate->expects($this->once())->method('render')->with($params);

        $stringParameter->getConvertedValue();
    }

    public function testConvertWithoutParams()
    {
        $value = 'value1';

        /** @var StringProviderParameter|\PHPUnit_Framework_MockObject_MockObject $stringParameter */
        $stringParameter = $this->createStringParameter();

        $stringParameter->setValue($value);

        $this->twig->expects($this->once())->method('createTemplate')->with($value);
        $this->twigTemplate->expects($this->once())->method('render')->with([]);

        $stringParameter->getConvertedValue();
    }

    public function testValueIsNotSet()
    {
        $this->setExpectedException(\Exception::class);

        /** @var StringProviderParameter|\PHPUnit_Framework_MockObject_MockObject $stringParameter */
        $stringParameter = $this->createStringParameter();

        $stringParameter->getConvertedValue();
    }

    private function createStringParameter()
    {
        return $this->getMockBuilder(StringProviderParameter::class)->setConstructorArgs(
            [$this->twig]
        )->getMockForAbstractClass()
            ;
    }
}
