<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Tests\Unit\Node;

use Unikorp\KongAdminApi\Document\ConsumerDocument as Document;
use Unikorp\KongAdminApi\Node\Consumer as Node;
use PHPUnit\Framework\TestCase;

/**
 * consumer test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ConsumerTest extends TestCase
{
    /**
     * client
     * @var \Unikorp\KongAdminApi\Client $client
     */
    private $client = null;

    /**
     * http client
     * @var \Http\Client\Common\HttpMethodsClient $httpClient
     */
    private $httpClient = null;

    /**
     * set up
     *
     * @return void
     *
     * @coversNothing
     */
    protected function setUp()
    {
        $this->client = $this->createMock('\Unikorp\KongAdminApi\Client');
        $this->httpClient = $this->createMock('\Http\Client\Common\HttpMethodsClient');
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
        $this->client = null;
        $this->httpClient = null;
    }

    /**
     * test construct set client
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractNode::__construct
     */
    public function testConstructSetClient()
    {
        $node = new Node($this->client);

        // reflect `node`
        $reflectionClass = new \ReflectionClass($node);

        // set `client` property from `node` parent (`abstract node`) accessible
        $reflectionProperty = $reflectionClass->getParentClass()->getProperty('client');
        $reflectionProperty->setAccessible(true);

        // asserts
        $this->assertSame($this->client, $reflectionProperty->getValue($node));
    }

    /**
     * test create consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::createConsumer
     * @covers \Unikorp\KongAdminApi\AbstractNode::post
     */
    public function testCreateConsumer()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `document`
        $document = $this->createMock(Document::class);

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // stub `to json` method from `document` mock
        $document->expects($this->once())
            ->method('toJson')
            ->will($this->returnValue('{"test":true}'));

        // stub `post` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo('/consumers/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->createConsumer($document);
    }

    /**
     * test retrieve consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::retrieveConsumer
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testRetrieveConsumer()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // stub `get` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('/consumers/test-consumer?'),
                $this->equalTo(['Content-Type' => 'application/x-www-form-urlencoded'])
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->retrieveConsumer('test-consumer');
    }

    /**
     * test list consumers
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::listConsumers
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testListConsumers()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // stub `get` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('get')
            ->with(
                $this->equalTo('/consumers/?'),
                $this->equalTo(['Content-Type' => 'application/x-www-form-urlencoded'])
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->listConsumers();
    }

    /**
     * test update consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::updateConsumer
     * @covers \Unikorp\KongAdminApi\AbstractNode::patch
     */
    public function testUpdateConsumer()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `document`
        $document = $this->createMock(Document::class);

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // stub `to json` method from `document` mock
        $document->expects($this->once())
            ->method('toJson')
            ->will($this->returnValue('{"test":true}'));

        // stub `patch` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('patch')
            ->with(
                $this->equalTo('/consumers/test-consumer'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updateConsumer('test-consumer', $document);
    }

    /**
     * test update or create consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::updateOrCreateConsumer
     * @covers \Unikorp\KongAdminApi\AbstractNode::put
     */
    public function testUpdateOrCreateConsumer()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `document`
        $document = $this->createMock(Document::class);

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // stub `set created at` method from `document` mock
        $document->expects($this->once())
            ->method('setCreatedAt')
            ->with($this->isType('int'));

        // stub `to json` method from `document` mock
        $document->expects($this->once())
            ->method('toJson')
            ->will($this->returnValue('{"test":true}'));

        // stub `put` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('put')
            ->with(
                $this->equalTo('/consumers/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updateOrCreateConsumer($document);
    }

    /**
     * test delete consumer
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Consumer::deleteConsumer
     * @covers \Unikorp\KongAdminApi\AbstractNode::delete
     */
    public function testDeleteConsumer()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // stub `delete` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('delete')
            ->with(
                $this->equalTo('/consumers/test-consumer'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('[]')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->deleteConsumer('test-consumer');
    }
}
