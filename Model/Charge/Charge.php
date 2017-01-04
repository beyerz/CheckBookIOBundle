<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:05
 */

namespace Beyerz\CheckBookIOBundle\Model\Charge;


use Beyerz\CheckBookIOBundle\Gateway\ChargeGateway;
use Beyerz\CheckBookIOBundle\Gateway\RestGateway;

class Charge
{
    const URI_CHARGE_CHECK = '/api/v1/charge';

    /**
     * @var RestGateway
     */
    private $gateway;

    /**
     * Check constructor.
     * @param ChargeGateway $gateway
     */
    public function __construct(ChargeGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param ChargeEntity $entity
     * @return \Beyerz\CheckBookIOBundle\Entity\Charge
     */
    public function charge(ChargeEntity $entity)
    {
        $response = $this->gateway->post(self::URI_CHARGE_CHECK, $entity);
        $body = $response->getBody();
        $body->add(['token'=>$entity->getToken()]);
        return new \Beyerz\CheckBookIOBundle\Entity\Charge($body);
    }
}