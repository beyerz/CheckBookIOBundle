<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 09/01/2017
 * Time: 11:34
 */

namespace Beyerz\CheckBookIOBundle\Tests\Model\Check;


use Beyerz\CheckBookIOBundle\Gateway\RestGateway;
use Beyerz\CheckBookIOBundle\Model\Check\Check;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Symfony\Component\HttpFoundation\ParameterBag;

class ListAllTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider listAllDataProvider
     * @param \Beyerz\CheckBookIOBundle\Entity\Check[] $expected
     */
    public function testListAll($expected)
    {
        $restGateway = $this->getGatewayMock();

        /** @var Check|\PHPUnit_Framework_MockObject_MockObject $checkMock */
        $checkMock = $this->getMockBuilder(Check::class)
            ->setMethods(null)
            ->setConstructorArgs([$restGateway])
            ->getMock();

        $checks = $checkMock->listAll();

        foreach ($checks as $key => $check) {
            $this->assertEquals($expected[$key]->serialize(), $check->serialize());
        }
    }

    public function listAllDataProvider()
    {
        return [
            [
                'expected' => [
                    new \Beyerz\CheckBookIOBundle\Entity\Check(new ParameterBag([
                        "address" => "test@testing.com",
                        "amount" => 100.0,
                        "check_num" => 5001,
                        "date" => "2017-01-08 10:16:10.501762",
                        "description" => null,
                        "id" => "5ba0676044134c41aa99f5f0d88ea67b",
                        "name" => "Testing LTD",
                        "status" => "UNPAID"
                    ])),
                    new \Beyerz\CheckBookIOBundle\Entity\Check(new ParameterBag([
                        "address" => "test@testing.com",
                        "amount" => 100.0,
                        "check_num" => 5026,
                        "date" => "2017-01-05 19:30:57.861785",
                        "description" => null,
                        "id" => "50be2e476bf84754a63d0765e52917aa",
                        "name" => "Testing LTD",
                        "status" => "IN_PROCESS"
                    ])),
                    new \Beyerz\CheckBookIOBundle\Entity\Check(new ParameterBag([
                        "address" => "test@testing.com",
                        "amount" => 100.0,
                        "check_num" => 5025,
                        "date" => "2017-01-05 19:27:35.104301",
                        "description" => null,
                        "id" => "3fd65ada51d749c8b4e96fc31103d994",
                        "name" => "Testing LTD",
                        "status" => "IN_PROCESS"
                    ])),
                    new \Beyerz\CheckBookIOBundle\Entity\Check(new ParameterBag([
                        "address" => "test@testing.com",
                        "amount" => 100.0,
                        "check_num" => 5024,
                        "date" => "2017-01-05 19:21:52",
                        "description" => null,
                        "id" => "9ca2db0fe12142b495acd27dd6b16b1a",
                        "name" => "Testing LTD",
                        "status" => "IN_PROCESS"
                    ])),
                ]
            ]
        ];
    }

    private function getClientMock()
    {
        $mock = new MockHandler([
            new \GuzzleHttp\Psr7\Response(200, array(
                'Content-Type' =>
                    array(
                        0 => 'application/json',
                    ),
                'Date' =>
                    array(
                        0 => 'Mon, 09 Jan 2017 09:44:34 GMT',
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
                        0 => '14476',
                    ),
                'Connection' =>
                    array(
                        0 => 'keep-alive',
                    ),
            ),
                '{"checks": [
                    {
                      "address": "test@testing.com",
                      "amount": 100.0,
                      "check_num": 5001,
                      "date": "2017-01-08 10:16:10.501762",
                      "description": null,
                      "id": "5ba0676044134c41aa99f5f0d88ea67b",
                      "name": "Testing LTD",
                      "status": "UNPAID"
                    },
                    {
                      "address": "test@testing.com",
                      "amount": 100.0,
                      "check_num": 5026,
                      "date": "2017-01-05 19:30:57.861785",
                      "description": null,
                      "id": "50be2e476bf84754a63d0765e52917aa",
                      "name": "Testing LTD",
                      "status": "IN_PROCESS"
                    },
                    {
                      "address": "test@testing.com",
                      "amount": 100.0,
                      "check_num": 5025,
                      "date": "2017-01-05 19:27:35.104301",
                      "description": null,
                      "id": "3fd65ada51d749c8b4e96fc31103d994",
                      "name": "Testing LTD",
                      "status": "IN_PROCESS"
                    },
                    {
                      "address": "test@testing.com",
                      "amount": 100.0,
                      "check_num": 5024,
                      "date": "2017-01-05 19:21:52",
                      "description": null,
                      "id": "9ca2db0fe12142b495acd27dd6b16b1a",
                      "name": "Testing LTD",
                      "status": "IN_PROCESS"
                    }]}',
                '1.1',
                'OK')
        ]);
        $handler = HandlerStack::create($mock);
        return new Client([
            'handler' => $handler,
            'headers' => [
                'Accept' => "application/json",
                'Content-Type' => "application/json",
            ]]);
    }

    private function getGatewayMock()
    {
        $client = $this->getClientMock();
        $gateway = $this->getMockBuilder(RestGateway::class)
            ->setMethods(['getPrivateKey', 'getPublicKey'])
            ->setConstructorArgs([$client])
            ->getMock();
        $gateway->expects($this->any())->method('getPrivateKey')->willReturn('mock_private_key');
        $gateway->expects($this->any())->method('getPublicKey')->willReturn('mock_public_key');
        return $gateway;
    }
}