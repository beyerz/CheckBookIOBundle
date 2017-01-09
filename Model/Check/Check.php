<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Check;


use Beyerz\CheckBookIOBundle\Entity\Oauth;
use Beyerz\CheckBookIOBundle\Gateway\RestGateway;
use Beyerz\CheckBookIOBundle\Model\OauthInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class Check implements OauthInterface
{
    const URI_CREATE_CHECK = '/v2/check/digital';
    const URI_CANCEL_CHECK = '/v2/check/cancel/%s';
    const URI_LIST_CHECKS = '/v2/check';
    const URI_DETAILS_CHECK = "/v2/check/%s";

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

    public function create(CreateCheckEntity $entity)
    {
        $response = $this->gateway->post(self::URI_CREATE_CHECK, $this->oauth, $entity);
        $this->clearOauth();
        return new \Beyerz\CheckBookIOBundle\Entity\Check($response->getBody());
    }

    public function cancel($id)
    {
        $response = $this->gateway->get(sprintf(self::URI_CANCEL_CHECK, $id), $this->oauth);
        $this->clearOauth();
        return $response;
    }

    /**
     * @return \Beyerz\CheckBookIOBundle\Entity\Check[]
     */
    public function listAll()
    {
        $response = $this->gateway->get(self::URI_LIST_CHECKS, $this->oauth);
        $this->clearOauth();
        $list = [];
        foreach ($response->getBody()->get('checks') as $check) {
            array_push($list, new \Beyerz\CheckBookIOBundle\Entity\Check(new ParameterBag($check)));
        }
        return $list;
    }

    /**
     * @param $id
     * @return \Beyerz\CheckBookIOBundle\Entity\Check
     */
    public function details($id)
    {
        $response = $this->gateway->get(sprintf(self::URI_DETAILS_CHECK, $id), $this->oauth);
        $this->clearOauth();
        return new \Beyerz\CheckBookIOBundle\Entity\Check($response->getBody());
    }

    public function setOauth(Oauth $oauth)
    {
        $this->oauth = $oauth;
    }

    public function clearOauth()
    {
        $this->oauth = null;
    }
}