<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 27/12/2016
 * Time: 12:17
 */

namespace Beyerz\CheckBookIOBundle\Model;


use Beyerz\CheckBookIOBundle\Entity\Oauth;

interface OauthInterface
{
    public function setOauth(Oauth $oauth);
    public function clearOauth();
}