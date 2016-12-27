<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Invoice;


use Beyerz\CheckBookIOBundle\Entity\Oauth;
use Beyerz\CheckBookIOBundle\Gateway\Invoice\Create\Request as CreateRequest;
use Beyerz\CheckBookIOBundle\Gateway\Invoice\Create\Response as CreateResponse;
use Beyerz\CheckBookIOBundle\Gateway\RestGateway;
use Beyerz\CheckBookIOBundle\Model\OauthInterface;

class Invoice implements OauthInterface
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
     * @param CreateRequest $request
     * @return CreateResponse
     */
    public function create(CreateRequest $request){

    }

    public function cancel(){

    }

    public function listAll(){
        $response = $this->gateway->get('/v2/invoice', $this->oauth);
        $this->clearOauth();
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

    public function setOauth(Oauth $oauth){
        $this->oauth = $oauth;
    }

    public function clearOauth(){
        $this->oauth = null;
    }
}