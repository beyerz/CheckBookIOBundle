<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 21/12/2016
 * Time: 13:12
 */

namespace Beyerz\CheckBookIOBundle\Twig\Extensions;


use Beyerz\CheckBookIOBundle\Context\EmbeddedCheckContext;

class EmbeddedCheckExtension extends \Twig_Extension
{
    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $merchantName;

    /**
     * @var string
     */
    private $sandbox;

    /**
     * EmbeddedCheckExtension constructor.
     */
    public function __construct($publicKey, $merchantName, $sandbox)
    {
        $this->publicKey = $publicKey;
        $this->merchantName = $merchantName;
        $this->sandbox = $sandbox;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('embedded_check', array($this, 'embedCheck'), [
                'is_safe' => ['html']
            ]));
    }

    /**
     * @param EmbeddedCheckContext $context
     * @return string
     */
    public function embedCheck(EmbeddedCheckContext $context)
    {
        $form = '<form id="checkbook_io" method="POST">';
        $form .= '<input type="hidden" id="checkbook_var"';
        $form .= 'data-key="'.$this->publicKey.'"';
        $form .= 'data-amount="'.$context->getAmount().'"';
        $form .= 'data-name="'.$this->merchantName.'"';
        $form .= 'data-for="'.$this->merchantName.'"';
        $form .= 'data-description="'.$context->getDescription().'"';
        $form .= 'data-user-email ="'.$context->getUserEmail().'"';
        $form .= 'data-redirect-url ="'.$context->getRedirectUrl().'"';
        $form .= 'data-businessName ="'.$context->getBusinessName().'"';
        $form .= 'data-firstName ="'.$context->getFirstName().'"';
        $form .= 'data-lastName ="'.$context->getLastName().'"';
        if($this->sandbox) {
            $form .= 'data-env = "sandbox"';
        }
        $form .= '/>';
        $baseUri = $this->sandbox?"https://sandbox.checkbook.io":"https://checkbook.io";
        $form .= '<script src = "'.$baseUri.'/static/api/v1/checkbook.js" class="checkbook-button" id="checkbook_api_js"></script>';
        $form .= '</form>';
        return $form;
    }


    /* (non-PHPdoc)
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return "embeddedcheck_extension";
    }
}