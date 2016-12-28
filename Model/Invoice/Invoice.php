<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Invoice;


use Beyerz\CheckBookIOBundle\Entity\Oauth;
use Beyerz\CheckBookIOBundle\Gateway\RestGateway;
use Beyerz\CheckBookIOBundle\Model\OauthInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

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

    public function create(){
        throw new \Exception(sprintf("Function not yet implemented: %s::", __CLASS__,__FUNCTION__));
    }

    public function cancel(){
        throw new \Exception(sprintf("Function not yet implemented: %s::", __CLASS__,__FUNCTION__));
    }

    public function listAll(){
        $response = $this->gateway->get('/v2/invoice', $this->oauth);
        $this->clearOauth();
        $list = [];
        foreach ($response->getBody()->get('invoices') as $invoice) {
            array_push($list, new \Beyerz\CheckBookIOBundle\Entity\Invoice(new ParameterBag($invoice)));
        }
        return $list;
    }

    public function details(){
        throw new \Exception(sprintf("Function not yet implemented: %s::", __CLASS__,__FUNCTION__));
    }

    public function setOauth(Oauth $oauth){
        $this->oauth = $oauth;
    }

    public function clearOauth(){
        $this->oauth = null;
    }
}