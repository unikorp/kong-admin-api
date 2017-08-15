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

use Unikorp\KongAdminApi\Document\TargetDocument as Document;
use Unikorp\KongAdminApi\Node\TargetNode as Node;
use PHPUnit\Framework\TestCase;

/**
 * target node test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class TargetNodeTest extends TestCase
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
     * test add target
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\TargetNode::addTarget
     * @covers \Unikorp\KongAdminApi\AbstractNode::post
     */
    public function testAddTarget()
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
                $this->equalTo('/upstreams/test-upstream/targets'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->addTarget('test-upstream', $document);
    }

    /**
     * test list targets
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\TargetNode::listTargets
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testListTargets()
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
                $this->equalTo('/upstreams/test-upstream/targets?'),
                $this->equalTo(['Content-Type' => 'application/x-www-form-urlencoded'])
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->listTargets('test-upstream');
    }

    /**
     * test list active targets
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\TargetNode::listActiveTargets
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testListActiveTargets()
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
                $this->equalTo('/upstreams/test-upstream/targets/active?'),
                $this->equalTo(['Content-Type' => 'application/x-www-form-urlencoded'])
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->listActiveTargets('test-upstream');
    }

    /**
     * test delete target
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\TargetNode::deleteTarget
     * @covers \Unikorp\KongAdminApi\AbstractNode::delete
     */
    public function testDeleteTarget()
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
                $this->equalTo('/upstreams/test-upstream/targets/test-target'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('[]')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->deleteTarget('test-upstream', 'test-target');
    }
}
