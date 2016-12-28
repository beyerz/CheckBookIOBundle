<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 18/12/2016
 * Time: 14:09
 */

namespace Beyerz\CheckBookIOBundle\Gateway;


use Symfony\Component\HttpFoundation\ParameterBag;

class Response
{
    /**
     * @var array
     */
    private $headers;

    /**
     * @var ParameterBag
     */
    private $body;

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function addHeader($key,$value){
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * @return ParameterBag
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param ParameterBag $body
     * @return $this
     */
    public function setBody(ParameterBag $body)
    {
        $this->body = $body;
        return $this;
    }
}