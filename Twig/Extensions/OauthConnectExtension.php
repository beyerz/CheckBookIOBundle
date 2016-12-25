<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 21/12/2016
 * Time: 13:12
 */

namespace Beyerz\CheckBookIOBundle\Twig\Extensions;


class OauthConnectExtension extends \Twig_Extension
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $redirectUri;

    /**
     * @var string
     */
    private $sandbox;

    /**
     * @param $clientId
     * @param $redirectUri
     * @param $sandbox
     */
    public function __construct($clientId, $redirectUri, $sandbox)
    {
        $this->clientId = $clientId;
        $this->redirectUri = $redirectUri;
        $this->sandbox = $sandbox;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('checkbook_connect', array($this, 'oauthConnect'), [
                'is_safe' => ['html']
            ]));
    }

    /**
     * @return string
     */
    public function oauthConnect()
    {
        $queryParams = [
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'scope' => 'check',
            'redirect_uri' => $this->redirectUri
        ];
        $queryString = http_build_query($queryParams);
        $href = sprintf('%s%s%s',$this->sandbox?'https://sandbox.checkbook.io':'https://checkbook.io','/oauth/authorize?',$queryString);
        $href = 'http://www.testing.com:8001/app_dev.php/checkbookio/connect?redirect=true';
        $html = '<a href="'.$href.'"><button>Checkbook Connect</button></a>';
        return $html;
    }


    /* (non-PHPdoc)
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return "oauthconnect_extension";
    }
}