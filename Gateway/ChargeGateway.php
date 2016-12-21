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

class ChargeGateway extends Gateway
{

    /**
     * @param string $uri
     * @param ChargeEntity $entity
     * @return Response
     */
    final public function post($uri, ChargeEntity $entity)
    {
        try {
            $httpResponse = $this->client->request('POST', $uri, array_merge($this->headers(),$this->body($entity)));
        } catch (ClientException $e) {
            throw $e;
        }
        return $this->buildResponse($httpResponse);
    }

    protected  function headers(){
        return [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ];
    }

    protected function body(ChargeEntity $entity){
        $key = $this->container->getParameter('beyerz.checkbook.private_key');
        $body = http_build_query(array_merge($entity->jsonSerialize(),['key' => $key]));
        return ['body' => $body];
    }

    /**
     * @param Psr7Response $httpResponse
     * @return Response
     */
    private function buildResponse(Psr7Response $httpResponse){
        $response = new Response();
        $response->setHeaders($httpResponse->getHeaders())
            ->addHeader('Status-Code',$httpResponse->getStatusCode())
            ->setBody(json_decode($httpResponse->getBody()->getContents(), true));
        return $response;
    }
}