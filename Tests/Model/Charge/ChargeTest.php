<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 29/12/2016
 * Time: 11:39
 */

namespace Beyerz\CheckBookIOBundle\Tests\Model\Charge;


use Beyerz\CheckBookIOBundle\Gateway\ChargeGateway;
use Beyerz\CheckBookIOBundle\Model\Charge\Charge;
use Beyerz\CheckBookIOBundle\Model\Charge\ChargeEntity;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Symfony\Component\HttpFoundation\ParameterBag;

class ChargeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider chargeDataProvider
     * @param ChargeEntity $entity
     * @param $expected
     */
    public function testCharge(ChargeEntity $entity, \Beyerz\CheckBookIOBundle\Entity\Charge $expected)
    {
        $chargeGatewayMock = $this->getGatewayMock();

        /** @var Charge|\PHPUnit_Framework_MockObject_MockObject $chargeMock */
        $chargeMock = $this->getMockBuilder(Charge::class)
            ->setMethods(null)
            ->setConstructorArgs([$chargeGatewayMock])
            ->getMock();

        $charge = $chargeMock->charge($entity);

        $this->assertEquals($expected->serialize(), $charge->serialize());

    }

    public function chargeDataProvider()
    {
        return [
            [
                'token' => new ChargeEntity(),
                'expects' => new \Beyerz\CheckBookIOBundle\Entity\Charge(new ParameterBag([
                    'id' => 'e1e759e8912f4c05ae1b414fe4509f8d',
                    'token' => null,
                    'check_id' => '213rfr243f12f433f3',
                    'created' => '10 Jan 2017',
                    'message' => 'Transaction successful',
                    'status' => 'SUCCESS',
                    'error' => 'no errors',
                ]))
            ]
        ];
    }

    private function getClientMock()
    {
        $mock = new MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [
                'Content-Type' =>
                    array(
                        0 => 'application/json',
                    ),
                'Date' =>
                    array(
                        0 => 'Wed, 04 Jan 2017 15:19:41 GMT',
                    ),
                'Server' =>
                    array(
                        0 => 'nginx/1.4.6 (Ubuntu)',
                    ),
                'Strict-Transport-Security' =>
                    array(
                        0 => 'max-age=31536000',
                    ),
                'Content-Length' =>
                    array(
                        0 => '136',
                    ),
                'Connection' =>
                    array(
                        0 => 'keep-alive',
                    ),
            ],
                '{"created": "10 Jan 2017","id": "e1e759e8912f4c05ae1b414fe4509f8d","check_id":"213rfr243f12f433f3","message": "Transaction successful","status": "SUCCESS"}',
                '1.1',
                'OK')
        ]);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);
    }

    private function getGatewayMock()
    {
        $client = $this->getClientMock();
        $gateway = $this->getMockBuilder(ChargeGateway::class)
            ->setMethods(['getPrivateKey'])
            ->setConstructorArgs([$client])
            ->getMock();
        $gateway->expects($this->any())->method('getPrivateKey')->willReturn('mock_private_key');
        return $gateway;
    }
}