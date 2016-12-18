<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Invoice;


use Beyerz\CheckBookIOBundle\Gateway\Invoice\Create\Request as CreateRequest;
use Beyerz\CheckBookIOBundle\Gateway\Invoice\Create\Response as CreateResponse;
use Beyerz\CheckBookIOBundle\Gateway\RestGateway;

class Invoice
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
     * @param CreateRequest $request
     * @return CreateResponse
     */
    public function create(CreateRequest $request){

    }

    public function cancel(){

    }

    public function listAll(){
        $response = $this->gateway->get('/v2/invoice');
        var_dump($response);die;
        $list = [];
        foreach ($response['checks'] as $checkArray) {
            $check = new \Beyerz\CheckBookIOBundle\Entity\Check($checkArray);
            array_push($list, $check);
        }
        return $list;
    }

    public function details(){

    }
}