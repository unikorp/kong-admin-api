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

use Unikorp\KongAdminApi\Document\UpstreamDocument as Document;
use Unikorp\KongAdminApi\Node\UpstreamNode as Node;
use PHPUnit\Framework\TestCase;

/**
 * upstream node test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class UpstreamNodeTest extends TestCase
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
     * test add upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\UpstreamNode::addUpstream
     * @covers \Unikorp\KongAdminApi\AbstractNode::post
     */
    public function testAddUpstream()
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
                $this->equalTo('/upstreams/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->addUpstream($document);
    }

    /**
     * test retrieve upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\UpstreamNode::retrieveUpstream
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testRetrieveUpstream()
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
                $this->equalTo('/upstreams/test-upstream?'),
                $this->equalTo(['Content-Type' => 'application/x-www-form-urlencoded'])
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->retrieveUpstream('test-upstream');
    }

    /**
     * test list upstreams
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\UpstreamNode::listUpstreams
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testListUpstreams()
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
                $this->equalTo('/upstreams/?'),
                $this->equalTo(['Content-Type' => 'application/x-www-form-urlencoded'])
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->listUpstreams();
    }

    /**
     * test update upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\UpstreamNode::updateUpstream
     * @covers \Unikorp\KongAdminApi\AbstractNode::patch
     */
    public function testUpdateUpstream()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // mock `document`
        $document = $this->createMock(Document::class);

        // stub `to json` method from `document` mock
        $document->expects($this->once())
            ->method('toJson')
            ->will($this->returnValue('{"test":true}'));

        // stub `get` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('patch')
            ->with(
                $this->equalTo('/upstreams/test-upstream'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updateUpstream('test-upstream', $document);
    }

    /**
     * test update or create upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\UpstreamNode::updateOrCreateUpstream
     * @covers \Unikorp\KongAdminApi\AbstractNode::put
     */
    public function testUpdateOrCreateUpstream()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `response`
        $response = $this->createMock('\GuzzleHttp\Psr7\Response');

        // mock `document`
        $document = $this->createMock(Document::class);

        // stub `set created at` method from `document` mock
        $document->expects($this->once())
            ->method('setCreatedAt')
            ->with($this->isType('int'));

        // stub `to json` method from `document` mock
        $document->expects($this->once())
            ->method('toJson')
            ->will($this->returnValue('{"test":true}'));

        // stub `get` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('put')
            ->with(
                $this->equalTo('/upstreams/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updateOrCreateUpstream($document);
    }

    /**
     * test delete upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\UpstreamNode::deleteUpstream
     * @covers \Unikorp\KongAdminApi\AbstractNode::delete
     */
    public function testDeleteUpstream()
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
                $this->equalTo('/upstreams/test-upstream'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('[]')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->deleteUpstream('test-upstream');
    }
}
