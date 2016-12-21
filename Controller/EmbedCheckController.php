<?php

namespace Beyerz\CheckBookIOBundle\Controller;

use Beyerz\CheckBookIOBundle\Context\EmbeddedCheckContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EmbedCheckController extends Controller
{
    /**
     *
     */
    public function indexAction()
    {
        $context = new EmbeddedCheckContext();

        $context->setAmount(200)
            ->setDescription('Test Tranasction')
            ->setUserEmail("test@email.com")
            ->setRedirectUrl("/")
            ->setBusinessName('Acme inc')
            ->setFirstName('Test')
            ->setLastName("TheDude");
        return $this->render('CheckBookIOBundle:EmbedCheck:index.html.twig', array(
            'context' => $context
        ));
    }

}
