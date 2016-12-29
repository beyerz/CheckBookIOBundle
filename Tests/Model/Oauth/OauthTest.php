<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 29/12/2016
 * Time: 11:39
 */

namespace Beyerz\CheckBookIOBundle\Tests\Model\Oauth;


use Beyerz\CheckBookIOBundle\Gateway\UrlEncodedGateway;
use Beyerz\CheckBookIOBundle\Model\Check\Check;
use Beyerz\CheckBookIOBundle\Model\Invoice\Invoice;
use Beyerz\CheckBookIOBundle\Model\Oauth\Oauth;
use Beyerz\CheckBookIOBundle\Model\Oauth\OauthTokenEntity;
use Beyerz\CheckBookIOBundle\Model\Subscription\Subscription;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Symfony\Component\HttpFoundation\ParameterBag;

class OauthTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider tokenDataProvider
     * @param $expected
     */
    public function testToken(OauthTokenEntity $token, $expected)
    {

        $urlEncodedGatewayMock = $this->getGatewayMock();
        $checkMock = $this->getCheckMock();
        $invoiceMock = $this->getInvoiceMock();
        $subscriptionMock = $this->getSubscriptionMock();

        /** @var Oauth|\PHPUnit_Framework_MockObject_MockObject $oauthMock */
        $oauthMock = $this->getMockBuilder(Oauth::class)
            ->setMethods(null)
            ->setConstructorArgs([$urlEncodedGatewayMock, $checkMock, $invoiceMock, $subscriptionMock])
            ->getMock();

        $oauth = $oauthMock->token($token);

        $this->assertEquals($expected,$oauth);

    }

    public function tokenDataProvider()
    {
        return [
            [
                'token' => new OauthTokenEntity(),
                'expects' => new \Beyerz\CheckBookIOBundle\Entity\Oauth(new ParameterBag([
                    'access_token' => 'WNdvqFsNrIb1JMQvFw6yx0VtUZriIj',
                    'token_type' => 'Bearer',
                    'expires_in' => 15552000,
                    'refresh_token' => 'czJ1y6577XnQGEbrKEHg8H80JNfyyP',
                    'scope' => 'check',
                ]))
            ]
        ];
    }

    private function getClientMock()
    {
        $mock = new MockHandler([
            new \GuzzleHttp\Psr7\Response(200, [
                'Cache-Control' =>
                    array(
                        0 => 'no-store',
                    ),
                'Content-Type' =>
                    array(
                        0 => 'application/json',
                    ),
                'Date' =>
                    array(
                        0 => 'Thu, 29 Dec 2016 09:59:42 GMT',
                    ),
                'Pragma' =>
                    array(
                        0 => 'no-cache',
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
                        0 => '167',
                    ),
                'Connection' =>
                    array(
                        0 => 'keep-alive',
                    ),
            ],
                '{"access_token": "WNdvqFsNrIb1JMQvFw6yx0VtUZriIj", "token_type": "Bearer", "expires_in": 15552000, "refresh_token": "czJ1y6577XnQGEbrKEHg8H80JNfyyP", "scope": "check"}',
                '1.1', 'OK')
        ]);
        $handler = HandlerStack::create($mock);
        return new Client(['handler' => $handler]);
    }

    private function getGatewayMock()
    {
        $client = $this->getClientMock();
        return $this->getMockBuilder(UrlEncodedGateway::class)
            ->setMethods(null)
            ->setConstructorArgs([$client])
            ->getMock();
    }

    private function getCheckMock()
    {
        return $this->getMockBuilder(Check::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function getInvoiceMock()
    {
        return $this->getMockBuilder(Invoice::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function getSubscriptionMock()
    {
        return $this->getMockBuilder(Subscription::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}