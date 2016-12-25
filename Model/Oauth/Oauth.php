<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Oauth;


use Beyerz\CheckBookIOBundle\Gateway\UrlEncodedGateway;
use GuzzleHttp\Exception\ClientException;

class Oauth
{
    const URI_TOKEN = '/oauth/token';

    /**
     * @var UrlEncodedGateway
     */
    private $gateway;

    /**
     * Check constructor.
     * @param UrlEncodedGateway $gateway
     */
    public function __construct(UrlEncodedGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function token(OauthTokenEntity $entity)
    {
        try {
            $response = $this->gateway->post(self::URI_TOKEN, $entity);
            $oauth = new \Beyerz\CheckBookIOBundle\Entity\Oauth($response->getBody());
            return $oauth;
        }catch(ClientException $e){
            throw $e;
        }
    }
}