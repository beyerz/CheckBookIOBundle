<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:47
 */

namespace Beyerz\CheckBookIOBundle\Gateway;


use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Gateway
{
    use ContainerAwareTrait;

    /**
     * @var Client
     */
    protected $client;

    /**
     * Gateway constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    protected function authorizationHeader($method, $uri)
    {

        $dateTime = new \DateTime('now');
        $timeStamp = $dateTime->format("Y-m-d H:i:s.U");
        $message = sprintf('%s%s%s%s',strtoupper($method),$this->client->getConfig('headers')['Accept'],$timeStamp,$uri);
        $dig = hash_hmac('sha256', $message, $this->container->getParameter('beyerz.checkbook.private_key'),true);
        $sig = base64_encode($dig);
        return [
            'headers' => [
                'Date' => $timeStamp,
                'Authorization' => sprintf('%s:%s',$this->container->getParameter('beyerz.checkbook.public_key'),$sig)
            ]
        ];
    }
}