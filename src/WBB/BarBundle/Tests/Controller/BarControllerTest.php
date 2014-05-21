<?php

namespace WBB\BarBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BarControllerTest extends WebTestCase
{
    public function testDetails()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/bar/details');
    }

}
