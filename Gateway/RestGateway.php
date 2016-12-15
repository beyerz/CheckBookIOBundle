<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 30/11/2016
 * Time: 18:44
 */

namespace Beyerz\CheckBookIOBundle\Gateway;

use GuzzleHttp\Exception\ClientException;

class RestGateway extends Gateway
{

    final public function post($uri)
    {
        $response = $this->client->request('POST', $uri, $this->authorizationHeader('GET', 'v2/check'));
        var_dump($response->getHeaders());
        echo $response->getStatusCode();
    }

    final function get($uri)
    {
        try {
            $response = $this->client->request('GET', $uri, $this->authorizationHeader('GET', $uri));
        } catch (ClientException $e) {
            $e->getRequest()->getHeaders();
            throw $e;
        }
        return json_decode($response->getBody()->getContents(), true);
    }

    final function update()
    {

    }

    final function delete()
    {

    }
}