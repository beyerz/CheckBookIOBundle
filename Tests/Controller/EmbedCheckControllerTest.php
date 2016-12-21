<?php

namespace Beyerz\CheckBookIOBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmbedCheckControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/checkbookio/embed-check');

        $this->assertContains('<form id="checkbook_io" method="POST">', $client->getResponse()->getContent());
    }

}
