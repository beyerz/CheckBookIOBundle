<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 22/12/2016
 * Time: 13:26
 */

namespace Beyerz\CheckBookIOBundle\Model\Oauth;


class OauthTokenEntity implements \JsonSerializable
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $grantType;

    /**
     * @var string
     */
    private $scope;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $redirectUri;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return OauthTokenEntity
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * @param string $grantType
     * @return OauthTokenEntity
     */
    public function setGrantType($grantType)
    {
        $this->grantType = $grantType;
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
     * @return OauthTokenEntity
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return OauthTokenEntity
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     * @return OauthTokenEntity
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return OauthTokenEntity
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'client_id' => $this->getClientId(),
            'grant_type' => $this->getGrantType(),
            'scope' => $this->getScope(),
            'code' => $this->getCode(),
            'redirect_uri' => $this->getRedirectUri(),
            'client_secret' => $this->getClientSecret(),
        ];
    }
}