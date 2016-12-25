<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 21/12/2016
 * Time: 13:12
 */

namespace Beyerz\CheckBookIOBundle\Twig\Extensions;


use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class OauthConnectExtension extends \Twig_Extension
{

    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
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
        $connectUrl = $this->router->generate('check_book_io_oauth_connect',['redirect'=>true],UrlGeneratorInterface::ABSOLUTE_URL);
        $html = '<a href="'.$connectUrl.'"><button>Checkbook Connect</button></a>';
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