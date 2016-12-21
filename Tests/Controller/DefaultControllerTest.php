<?php

namespace Beyerz\CheckBookIOBundle\Tests\Controller;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Beyerz\CheckBookIOBundle\Controller\DefaultController;

class DefaultControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/checkbookio/');

        $this->assertContains('Checkbook.io Symfony Bundle', $client->getResponse()->getContent());
    }
}
