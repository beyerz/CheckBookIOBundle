<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model;


use Beyerz\CheckBookIOBundle\Gateway\RestGateway;

class Check
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

    public function create()
    {
        throw new \Exception("Still to be implemented: " . __CLASS__ . ":" . __FUNCTION__);
    }

    public function cancel()
    {
        throw new \Exception("Still to be implemented: " . __CLASS__ . ":" . __FUNCTION__);
    }

    public function listAll()
    {
        $response = $this->gateway->get('/v2/check');
        $list = [];
        foreach ($response['checks'] as $checkArray) {
            $check = new \Beyerz\CheckBookIOBundle\Entity\Check($checkArray);
            array_push($list, $check);
        }
        return $list;
    }

    public function details($id)
    {
        return $this->gateway->get("/v2/check/$id");
    }
}