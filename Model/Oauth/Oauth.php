<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Oauth;


use Beyerz\CheckBookIOBundle\Gateway\UrlEncodedGateway;
use Beyerz\CheckBookIOBundle\Model\Check\Check;
use Beyerz\CheckBookIOBundle\Model\Invoice\Invoice;
use Beyerz\CheckBookIOBundle\Model\Subscription\Subscription;
use GuzzleHttp\Exception\ClientException;
use \Beyerz\CheckBookIOBundle\Entity\Oauth as OauthEntity;

class Oauth
{
    const URI_TOKEN = '/oauth/token';

    /**
     * @var UrlEncodedGateway
     */
    private $gateway;

    /**
     * @var Check
     */
    private $check;

    /**
     * @var Invoice
     */
    private $invoice;

    /**
     * @var Subscription
     */
    private $subscription;

    /**
     * Check constructor.
     * @param UrlEncodedGateway $gateway
     * @param Check $check
     * @param Invoice $invoice
     * @param Subscription $subscription
     */
    public function __construct(UrlEncodedGateway $gateway, Check $check, Invoice $invoice, Subscription $subscription)
    {
        $this->gateway = $gateway;
        $this->check = $check;
        $this->invoice = $invoice;
        $this->subscription = $subscription;
    }

    public function token(OauthTokenEntity $entity)
    {
        try {
            $response = $this->gateway->post(self::URI_TOKEN, $entity);
            $oauth = new OauthEntity($response->getBody());
            return $oauth;
        }catch(ClientException $e){
            throw $e;
        }
    }

    /**
     * @param OauthEntity $oauth
     * @return Check
     */
    public function check(OauthEntity $oauth){
        $this->check->setOauth($oauth);
        return $this->check;
    }

    /**
     * @param OauthEntity $oauth
     * @return Invoice
     */
    public function invoice(OauthEntity $oauth){
        $this->invoice->setOauth($oauth);
        return $this->invoice;
    }

    /**
     * @param OauthEntity $oauth
     * @return Subscription
     */
    public function subscription(OauthEntity $oauth){
        $this->subscription->setOauth($oauth);
        return $this->subscription;
    }
}