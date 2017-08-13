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
use Unikorp\KongAdminApi\Document\Consumer as Document;
use Unikorp\KongAdminApi\Node\Consumer as Node;

/**
 * consumer test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ConsumerTest extends TestCase
{
    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\Consumer $node
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
        $this->node = $client->getNode('consumer');

        // fixture: add consumer
        $document = new Document();
        $document
            ->setUsername('TestConsumer');
        $this->node->createConsumer($document);
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
        // remove consumers
        $consumers = json_decode($this->node->listConsumers()->getBody()->getContents(), true)['data'];
        array_walk($consumers, function ($consumer) {
            $this->node->deleteConsumer($consumer['username']);
        });

        // reset node
        $this->node = null;
    }

    /**
     * test create consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::createConsumer
     */
    public function testCreateConsumer()
    {
        // prepare document
        $document = new Document();
        $document
            ->setUsername('testCreateConsumer');

        // assert
        $response = $this->node->createConsumer($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'username' => 'testCreateConsumer',
        ], $data);
    }

    /**
     * test retrieve consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::retrieveConsumer
     */
    public function testRetrieveConsumer()
    {
        // assert
        $response = $this->node->retrieveConsumer('TestConsumer');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'username' => 'TestConsumer',
        ], $data);
    }

    /**
     * test list consumers
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::listConsumers
     */
    public function testlistConsumers()
    {
        // assert
        $response = $this->node->listConsumers();
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 1,
            'data' => [
                [
                    'username' => 'TestConsumer',
                ]
            ]
        ], $data);
    }

    /**
     * test update consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::updateConsumer
     */
    public function testUpdateConsumer()
    {
        // prepare document
        $document = new Document();
        $document
            ->setUsername('testUpdateConsumer');

        // assert
        $response = $this->node->updateConsumer('TestConsumer', $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'username' => 'testUpdateConsumer',
        ], $data);
    }

    /**
     * test update or create consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::updateOrCreateConsumer
     */
    public function testUpdateOrCreateConsumer()
    {
        // prepare document
        $document = new Document();
        $document
            ->setUsername('testUpdateOrCreateConsumer');

        // assert
        $response = $this->node->updateOrCreateConsumer($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'username' => 'testUpdateOrCreateConsumer',
        ], $data);
    }

    /**
     * test delete consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::deleteConsumer
     */
    public function testDeleteConsumer()
    {
        // assert
        $response = $this->node->deleteConsumer('TestConsumer');

        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame('No Content', $response->getReasonPhrase());
    }
}
