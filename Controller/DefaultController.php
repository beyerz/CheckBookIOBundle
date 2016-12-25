<?php

namespace Beyerz\CheckBookIOBundle\Controller;

use Beyerz\CheckBookIOBundle\Gateway\Invoice\Create\Request as CreateRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('CheckBookIOBundle:Default:index.html.twig');
    }
}
