<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Subscription;


use Beyerz\CheckBookIOBundle\Entity\Oauth;
use Beyerz\CheckBookIOBundle\Gateway\RestGateway;
use Beyerz\CheckBookIOBundle\Model\OauthInterface;

class Subscription implements OauthInterface
{
    /**
     * @var RestGateway
     */
    private $gateway;

    /**
     * @var Oauth
     */
    private $oauth;

    /**
     * Check constructor.
     * @param RestGateway $gateway
     */
    public function __construct(RestGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @return CreateResponse
     */
    public function create(){

    }

    public function cancel(){

    }

    public function listAll(){
        $response = $this->gateway->get('/v2/subscription', $this->oauth);
        $list = [];
        foreach ($response->getBody()['subscriptions'] as $subscription) {
            $sub = new \Beyerz\CheckBookIOBundle\Entity\Subscription($subscription);
            array_push($list, $sub);
        }
        return $list;
    }

    public function details(){

    }

    public function setOauth(Oauth $oauth){
        $this->oauth = $oauth;
    }

    public function clearOauth(){
        $this->oauth = null;
    }
}