<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 22/12/2016
 * Time: 16:20
 */

namespace Beyerz\CheckBookIOBundle\Entity;


class Oauth
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $tokenType;

    /**
     * @var string
     */
    private $refreshToken;

    /**
     * @var string
     */
    private $scope;

    /**
     * Oauth constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->accessToken = $config['access_token'];
        $this->tokenType = $config['token_type'];
        $this->refreshToken = $config['refresh_token'];
        $this->scope = $config['scope'];
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @return Oauth
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @param string $tokenType
     * @return Oauth
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     * @return Oauth
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return Oauth
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }
}