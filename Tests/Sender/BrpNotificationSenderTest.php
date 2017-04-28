<?php
namespace Brp\NotificationSenderBundle\Tests\Sender;

use Brp\NotificationSenderBundle\Entity\NotificationTemplate;
use Brp\NotificationSenderBundle\Entity\Provider;
use Brp\NotificationSenderBundle\NotificationType\NotificationTypeInterface;
use Brp\NotificationSenderBundle\Parameter\ProviderConnectionParameterInterface;
use Brp\NotificationSenderBundle\Parameter\ProviderTemplateParameterInterface;
use Brp\NotificationSenderBundle\Provider\ProviderInterface;
use Brp\NotificationSenderBundle\Repository\NotificationTemplateRepository;
use Brp\NotificationSenderBundle\Sender\BrpNotificationSender;

class BrpNotificationSenderTest extends \PHPUnit_Framework_TestCase
{
    /** @var BrpNotificationSender|\PHPUnit_Framework_MockObject_MockObject $notificationSender */
    private $notificationSender;

    /** @var ProviderInterface|\PHPUnit_Framework_MockObject_MockObject $provider */
    private $provider;

    /** @var NotificationTypeInterface|\PHPUnit_Framework_MockObject_MockObject $notificationType */
    private $notificationType;

    protected function setUp()
    {
        $em = $this->getMock('Doctrine\ORM\EntityManager', ['getRepository'], [], '', false);
//        $em->expects($this->any())
//            ->method('getRepository')
//            ->willReturn($this->getMock(NotificationTemplateRepository::class))
//            ;

        $logger = $this->getMock('Psr\Log\LoggerInterface');

        $this->notificationSender = new BrpNotificationSender($em, $logger);

        $this->provider = $this->getMock(
            ProviderInterface::class,
            ['getCode', 'checkAvailable', 'getConnectionParams', 'getDescription', 'getTemplateParams', 'send']
        );

        $this->notificationType = $this->getMock(
            NotificationTypeInterface::class,
            ['getName','getCode', 'getDescription', 'getParams', 'generateNotification']
        );
    }

    public function testLoadTemplateParams()
    {
        $this->assertTrue(3 > 1);
    }

    public function testAddProvider()
    {
        $sender = $this->notificationSender;
        $provider = $this->provider;

        $provider->expects($this->once())->method('getCode');

        $sender->addProvider($provider);
    }

    public function testGetProviders()
    {
        $sender = $this->notificationSender;
        $provider = $this->provider;
        $codeName = 'DummyCode';

        $provider->method('getCode')->willReturn($codeName);

        $sender->addProvider($provider);

        $this->assertArrayHasKey($codeName, $sender->getProviders());
    }

    public function testGetProviderByInvalidCode()
    {
        $sender = $this->notificationSender;

        $this->setExpectedException(\Exception::class);

        $sender->getProviderByCode('InvalidCode');
    }

    public function testAddNotificationType()
    {
        $sender = $this->notificationSender;
        $notificationType = $this->notificationType;

        $notificationType->expects($this->once())->method('getCode');

        $sender->addNotificationType($notificationType);
    }

    public function testGetNotificationTypes()
    {
        $sender = $this->notificationSender;
        $notificationType = $this->notificationType;
        $codeName = 'NotificationTypeCode';

        $notificationType->method('getCode')->willReturn($codeName);

        $sender->addNotificationType($notificationType);

        $this->assertArrayHasKey($codeName, $sender->getNotificationTypes());
    }

    public function testSend()
    {
        $em = $this->getEmMock();

        $storedProvider = new Provider();
        $storedProvider->setCode('ProviderCode');
        $storedProvider->setName('ProviderName');
        $storedProvider->setParameters(['Host' => 'Hostname', 'Port' => '80']);

        $notificationTemplate = new NotificationTemplate();
        $notificationTemplate->setNotificationCode('NotificationTypeCode');
        $notificationTemplate->setParameters(['Subject' => 'Notification Subject', 'Body' => 'Notification Body']);
        $notificationTemplate->setProvider($storedProvider);

        $repoMock = $this->getMock(NotificationTemplateRepository::class, ['getNotificationTemplatesByCode'], [], '', false);
        $repoMock->expects($this->once())
            ->method('getNotificationTemplatesByCode')
            ->with('NotificationTypeCode')
            ->willReturn([$notificationTemplate])
        ;

        $em->expects($this->once())->method('getRepository')->willReturn($repoMock);

        $notificationType = $this->notificationType;
        $notificationType
            ->expects($this->once())
            ->method('getCode')
            ->willReturn('NotificationTypeCode')
        ;

        /* Set up actualProvider */
        $actualProvider = $this->getActualProviderMock();
        $actualProvider
            ->expects($this->any())
            ->method('getCode')
            ->willReturn('ProviderCode')
        ;

        $providerTemplateSubjectParam = $this->getProviderTemplateParam();
        $providerTemplateSubjectParam
            ->expects($this->any())
            ->method('getCode')
            ->willReturn('Subject')
        ;

        $providerTemplateSubjectParam
            ->expects($this->once())
            ->method('setValue')
            ->with('Notification Subject')
        ;

        $providerTemplateBodyParam = $this->getProviderTemplateParam();
        $providerTemplateBodyParam
            ->expects($this->any())
            ->method('getCode')
            ->willReturn('Body')
        ;

        $providerTemplateBodyParam
            ->expects($this->once())
            ->method('setValue')
            ->with('Notification Body')
        ;

        $providerConnectionHostParam = $this->getProviderConnectionParam();
        $providerConnectionHostParam
            ->expects($this->any())
            ->method('getCode')
            ->willReturn('Host')
        ;

        $providerConnectionHostParam
            ->expects($this->once())
            ->method('setValue')
            ->with('Hostname')
        ;

        $providerConnectionPortParam = $this->getProviderConnectionParam();
        $providerConnectionPortParam
            ->expects($this->any())
            ->method('getCode')
            ->willReturn('Port')
        ;

        $providerConnectionPortParam
            ->expects($this->once())
            ->method('setValue')
            ->with('80')
        ;

        $actualProvider
            ->expects($this->any())
            ->method('getTemplateParams')
            ->willReturn([$providerTemplateBodyParam, $providerTemplateSubjectParam])
        ;

        $actualProvider
            ->expects($this->any())
            ->method('getConnectionParams')
            ->willReturn([$providerConnectionPortParam, $providerConnectionHostParam])
        ;

        $sender = new BrpNotificationSender($em, $this->getMock('Psr\Log\LoggerInterface'));
        $sender->addProvider($actualProvider);

        $sender->send($notificationType);
    }

    protected function getEmMock()
    {
        return $this->getMock('Doctrine\ORM\EntityManager', ['getRepository'], [], '', false);
    }

    protected function getActualProviderMock()
    {
        return $this->getMock(
            ProviderInterface::class,
            ['getCode', 'checkAvailable', 'getConnectionParams', 'getDescription', 'getTemplateParams', 'send']
        );
    }

    protected function getProviderTemplateParam()
    {
        return $this->getMock(
            ProviderTemplateParameterInterface::class,
            ['getCode', 'getName', 'getConvertedValue', 'getType', 'setRenderedValueWith', 'setValue']
        );
    }

    protected function getProviderConnectionParam()
    {
        return $this->getMock(
            ProviderConnectionParameterInterface::class,
            ['getType', 'getName', 'getCode', 'getValue', 'setValue']
        );
    }
}