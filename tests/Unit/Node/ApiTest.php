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

use Unikorp\KongAdminApi\Node\Api as Node;
use PHPUnit\Framework\TestCase;

/**
 * api test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ApiTest extends TestCase
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
     * test add api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::addApi
     * @covers \Unikorp\KongAdminApi\AbstractNode::post
     */
    public function testAddApi()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `document`
        $document = $this->createMock('\Unikorp\KongAdminApi\Document\Api');

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
                $this->equalTo('/apis/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->addApi($document);
    }

    /**
     * test retrieve api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::retrieveApi
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testRetrieveApi()
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
            ->with($this->equalTo('/apis/test-api'))
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->retrieveApi('test-api');
    }

    /**
     * test list apis
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::listApis
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testListApis()
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
            ->with($this->equalTo('/apis/'))
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->listApis();
    }

    /**
     * test update api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::updateApi
     * @covers \Unikorp\KongAdminApi\AbstractNode::patch
     */
    public function testUpdateApi()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // mock `document`
        $document = $this->createMock('\Unikorp\KongAdminApi\Document\Api');

        // stub `to json` method from `document` mock
        $document->expects($this->once())
            ->method('toJson')
            ->will($this->returnValue('{"test":true}'));

        // stub `get` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('patch')
            ->with(
                $this->equalTo('/apis/test-api'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updateApi('test-api', $document);
    }

    /**
     * test update or create api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::updateOrCreateApi
     * @covers \Unikorp\KongAdminApi\AbstractNode::put
     */
    public function testUpdateOrCreateApi()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // mock `document`
        $document = $this->createMock('\Unikorp\KongAdminApi\Document\Api');

        // stub `to json` method from `document` mock
        $document->expects($this->once())
            ->method('toJson')
            ->will($this->returnValue('{"test":true}'));

        // stub `get` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('put')
            ->with(
                $this->equalTo('/apis/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updateOrCreateApi($document);
    }

    /**
     * test delete api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Api::deleteApi
     * @covers \Unikorp\KongAdminApi\AbstractNode::delete
     */
    public function testDeleteApi()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // stub `get` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('delete')
            ->with(
                $this->equalTo('/apis/test-api'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('[]')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->deleteApi('test-api');
    }
}
