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
    /** @var StringProviderParameter|\PHPUnit_Framework_MockObject_MockObject $stringParameter */
    private $stringParameter;
    /** @var \Twig_Environment|\PHPUnit_Framework_MockObject_MockObject $twig */
    private $twig;
    /** @var Twig_TemplateInterface | \PHPUnit_Framework_MockObject_MockObject $twigTemplate */
    private $twigTemplate;

    public function setUp()
    {
        $this->twig = $this->getMockBuilder(\Twig_Environment::class)->getMock();

        $this->twigTemplate = $this->getMockBuilder(\Twig_TemplateInterface::class)->getMock();

        $this->twig->method('createTemplate')->willReturn($this->twigTemplate);

        $this->stringParameter = $this->getMockBuilder(StringProviderParameter::class)->setConstructorArgs(
            [$this->twig]
        )->getMockForAbstractClass()
        ;
    }

    public function testConvert()
    {
        $params = ['param1', 'param2'];
        $value = 'value';

        $this->stringParameter->setParameters($params);
        $this->stringParameter->setValue($value);

        $this->twig->expects($this->once())->method('createTemplate')->with($value);
        $this->twigTemplate->expects($this->once())->method('render')->with($params);

        $this->stringParameter->getConvertedValue();
    }
}
