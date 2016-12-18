<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 18/12/2016
 * Time: 14:09
 */

namespace Beyerz\CheckBookIOBundle\Gateway;


class Response
{
    /**
     * @var array
     */
    private $headers;

    /**
     * @var array
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
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param array $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }
}