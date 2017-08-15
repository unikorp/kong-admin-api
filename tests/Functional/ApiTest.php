<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Unikorp\KongAdminApi\Client;
use Unikorp\KongAdminApi\Configurator;
use Unikorp\KongAdminApi\Document\ApiDocument as Document;
use Unikorp\KongAdminApi\Node\Api as Node;

/**
 * api test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ApiTest extends TestCase
{
    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\Api $node
     */
    private $node = null;

    /**
     * set up
     *
     * @return void
     *
     * @coversNothing
     */
    protected function setUp()
    {
        // create configurator
        $configurator = new Configurator();
        $configurator->setBaseUri('http://127.0.0.1/');
        $configurator->setHeaders([
            'Host' => 'test.kong.localhost',
        ]);

        // create client
        $client = new Client($configurator);

        // get node
        $this->node = $client->getNode('api');

        // fixture: add apis
        $document = new Document();
        $document
            ->setName('TestApi')
            ->setHosts('test.api')
            ->setUpstreamUrl('http://test.api');
        $this->node->addApi($document);

        $document = new Document();
        $document
            ->setName('OtherApi')
            ->setHosts('other.api')
            ->setUpstreamUrl('http://other.api');
        $this->node->addApi($document);
    }

    /**
     * tear down
     *
     * @return void
     *
     * @coversNothing
     */
    protected function tearDown()
    {
        // remove apis
        $apis = json_decode($this->node->listApis()->getBody()->getContents(), true)['data'];
        array_walk($apis, function ($api) {
            $this->node->deleteApi($api['name']);
        });

        // reset node
        $this->node = null;
    }

    /**
     * test add api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::addApi
     */
    public function testAddApi()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('testAddApi')
            ->setHosts('127.0.0.1,localhost')
            ->setUpstreamUrl('http://localhost');

        // assert
        $response = $this->node->addApi($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'testAddApi',
            'hosts' => [
                '127.0.0.1',
                'localhost'
            ],
            'upstream_url' => 'http://localhost',
        ], $data);
    }

    /**
     * test retrieve api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::retrieveApi
     */
    public function testRetrieveApi()
    {
        // assert
        $response = $this->node->retrieveApi('TestApi');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'TestApi',
            'hosts' => [
                'test.api',
            ],
            'upstream_url' => 'http://test.api',
        ], $data);
    }

    /**
     * test list apis
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::listApis
     */
    public function testListApis()
    {
        // get api id
        $apiId = json_decode($this->node->listApis()->getBody()->getContents(), true)['data'][0]['id'];

        // prepare document
        $document = new Document();
        $document
            ->setSize(1)
            ->setOffset($apiId);

        // assert
        $response = $this->node->listApis($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 2,
            'data' => [
                [
                    'id' => $apiId,
                ]
            ]
        ], $data);
        $this->assertCount(1, $data['data']);
    }

    /**
     * test update api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::updateApi
     */
    public function testUpdateApi()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('testUpdateApi')
            ->setHosts('127.0.0.1,localhost')
            ->setUpstreamUrl('http://localhost');

        // assert
        $response = $this->node->updateApi('TestApi', $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'testUpdateApi',
            'hosts' => [
                '127.0.0.1',
                'localhost'
            ],
            'upstream_url' => 'http://localhost',
        ], $data);
    }

    /**
     * test update or create api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::updateOrCreateApi
     */
    public function testUpdateOrCreateApi()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('testUpdateOrCreateApi')
            ->setHosts('127.0.0.1,localhost')
            ->setUpstreamUrl('http://localhost');

        // assert
        $response = $this->node->updateOrCreateApi($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'testUpdateOrCreateApi',
            'hosts' => [
                '127.0.0.1',
                'localhost'
            ],
            'upstream_url' => 'http://localhost',
        ], $data);
    }

    /**
     * test delete api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::deleteApi
     */
    public function testDeleteApi()
    {
        // assert
        $response = $this->node->deleteApi('TestApi');

        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame('No Content', $response->getReasonPhrase());
    }
}
