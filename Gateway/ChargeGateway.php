<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:44
 */

namespace Beyerz\CheckBookIOBundle\Gateway;

use Beyerz\CheckBookIOBundle\Model\Charge\ChargeEntity;
use GuzzleHttp\Exception\ClientException;
use \GuzzleHttp\Psr7\Response as Psr7Response;

class ChargeGateway extends UrlEncodedGateway
{
    protected function body(\JsonSerializable $entity){
        $key = $this->container->getParameter('beyerz.checkbook.private_key');
        $body = http_build_query(array_merge($entity->jsonSerialize(),['key' => $key]));
        return ['body' => $body];
    }
}