<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Check;


use Beyerz\CheckBookIOBundle\Gateway\RestGateway;

class Check
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
     * Check constructor.
     * @param RestGateway $gateway
     */
    public function __construct(RestGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function create(CreateCheckEntity $entity)
    {
        $response = $this->gateway->post(self::URI_CREATE_CHECK, $entity);
        return new \Beyerz\CheckBookIOBundle\Entity\Check($response->getBody());
    }

    public function cancel($id)
    {
        $response = $this->gateway->get(sprintf(self::URI_CANCEL_CHECK,$id));
        return $response;
    }

    /**
     * @return array
     */
    public function listAll()
    {
        $response = $this->gateway->get(self::URI_LIST_CHECKS);
        $list = [];
        foreach ($response->getBody()['checks'] as $checkArray) {
            $check = new \Beyerz\CheckBookIOBundle\Entity\Check($checkArray);
            array_push($list, $check);
        }
        return $list;
    }

    /**
     * @param $id
     * @return \Beyerz\CheckBookIOBundle\Entity\Check
     */
    public function details($id)
    {
        $response =  $this->gateway->get(sprintf(self::URI_DETAILS_CHECK,$id));
        return new \Beyerz\CheckBookIOBundle\Entity\Check($response->getBody());
    }
}