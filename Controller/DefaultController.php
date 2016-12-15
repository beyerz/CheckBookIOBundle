<?php

namespace Beyerz\CheckBookIOBundle\Controller;

use Beyerz\CheckBookIOBundle\Gateway\Invoice\Create\Request as CreateRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route(path="/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $checkbookModel = $this->container->get('checkbook.model');
        $createRequest = new CreateRequest();
        $createRequest->setAmount(123)
//            ->setAttachment()
            ->setBusiness('acme')
            ->setDescription('just a joke')
            ->setEmail('peleg@lenderly.co')
            ->setFirstName('Peleg')
            ->setLastName('Bar Natan');
        $checkbookModel->invoice()->create($createRequest);

        return $this->render('CheckBookIOBundle:Default:index.html.twig');
    }
}
