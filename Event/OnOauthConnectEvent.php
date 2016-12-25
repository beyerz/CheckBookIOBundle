<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 22/12/2016
 * Time: 15:19
 */

namespace Beyerz\CheckBookIOBundle\Event;


use Beyerz\CheckBookIOBundle\Entity\Oauth;
use Symfony\Component\EventDispatcher\Event;

class OnOauthConnectEvent extends Event
{
    const EVENT_NAME = 'beyerz.checkbook.oauth.connect';

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $message;

    /**
     * @var Oauth
     */
    private $oauth;

    /**
     * OnOauthConnectEvent constructor.
     * @param Oauth $oauth
     */
    public function __construct(Oauth $oauth = null)
    {
        if(!is_null($oauth)) {
            $this->oauth = $oauth;
        }
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return OnOauthConnectEvent
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return OnOauthConnectEvent
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return Oauth
     */
    public function getOauth()
    {
        return $this->oauth;
    }

    /**
     * @param Oauth $oauth
     * @return OnOauthConnectEvent
     */
    public function setOauth($oauth)
    {
        $this->oauth = $oauth;
        return $this;
    }
}