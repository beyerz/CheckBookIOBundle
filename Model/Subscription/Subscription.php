<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Subscription;


use Beyerz\CheckBookIOBundle\Gateway\RestGateway;

class Subscription
{
    /**
     * @var RestGateway
     */
    private $gateway;

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
        $response = $this->gateway->get('/v2/subscription');
        $list = [];
        foreach ($response->getBody()['subscriptions'] as $subscription) {
            $sub = new \Beyerz\CheckBookIOBundle\Entity\Subscription($subscription);
            array_push($list, $sub);
        }
        return $list;
    }

    public function details(){

    }
}