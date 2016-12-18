<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:44
 */

namespace Beyerz\CheckBookIOBundle\Gateway;

use GuzzleHttp\Exception\ClientException;
use \GuzzleHttp\Psr7\Response as Psr7Response;

class RestGateway extends Gateway
{

    /**
     * @param string $uri
     * @param \JsonSerializable $entity
     * @return Response
     */
    final public function post($uri, \JsonSerializable $entity)
    {
        try {
            $httpResponse = $this->client->request('POST', $uri, array_merge($this->authorizationHeader('POST', $uri),$this->body($entity)));
        } catch (ClientException $e) {
            throw $e;
        }
        return $this->buildResponse($httpResponse);
    }

    /**
     * @param $uri
     * @return Response
     */
    final function get($uri)
    {
        try {
            $httpResponse = $this->client->request('GET', $uri, $this->authorizationHeader('GET', $uri));
        } catch (ClientException $e) {
            throw $e;
        }

        return $this->buildResponse($httpResponse);
    }

    final function update()
    {

    }

    final function delete()
    {

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