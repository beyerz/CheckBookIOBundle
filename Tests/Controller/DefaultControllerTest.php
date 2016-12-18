<?php

namespace Beyerz\CheckBookIOBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/checkbookio/');

        $this->assertContains('Checkbook.io Symfony Bundle', $client->getResponse()->getContent());
    }
}
