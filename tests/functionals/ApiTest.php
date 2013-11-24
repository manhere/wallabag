<?php
namespace Poche\Tests\Functionals;
use Poche\Tests\Functionals\Fixtures;

class ApiTest extends PocheWebTestCase
{
    public function testEmptyGetEntries()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/entries');

        $this->assertTrue($client->getResponse()->isOk());

        // Assert that the "Content-Type" header is "application/json"
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertEquals($client->getResponse()->getContent(), '[]');

        //Load some entries
        Fixtures::loadEntries($this->app['db']);

    }

    public function testGetEntries()
    {

        //Load some entries
        Fixtures::loadEntries($this->app['db']);

        $client = $this->createClient();
        $crawler = $client->request('GET', '/api/entries');

        $this->assertTrue($client->getResponse()->isOk());

        // Assert that the "Content-Type" header is "application/json"
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertEquals($client->getResponse()->getContent(),'{"id":"1","url":"http:\/\/deboutlesgens.com\/blog\/le-courage-de-vivre-consciemment\/","title":"Le courage de vivre consciemment","content":"Test content","updated":null,"status":null,"bookmark":"0","fetched":"1","user_id":"1"}');

    }
}
