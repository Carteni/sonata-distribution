<?php

namespace AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     *
     * @param $url
     */
    public function testPageIsSuccessful($url)
    {
        $credentials = [];

        if (!preg_match('/login$/', $url)) {
            $credentials = [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => 'admin',
            ];
        }

        $client = static::createClient([], $credentials);

        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()
                              ->isSuccessful());
    }

    public function urlProvider()
    {
        return [
            ['admin/login'],
            ['admin/dashboard'],

        ];
    }
}
