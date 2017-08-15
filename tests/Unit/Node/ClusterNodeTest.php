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

use Unikorp\KongAdminApi\Document\ClusterDocument as Document;
use Unikorp\KongAdminApi\Node\ClusterNode as Node;
use PHPUnit\Framework\TestCase;

/**
 * cluster node test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ClusterNodeTest extends TestCase
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
     * test retrieve cluster status
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\ClusterNode::retrieveClusterStatus
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testRetrieveClusterStatus()
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
                $this->equalTo('/cluster?'),
                $this->equalTo(['Content-Type' => 'application/x-www-form-urlencoded'])
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->retrieveClusterStatus();
    }

    /**
     * test add a node
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\ClusterNode::addANode
     * @covers \Unikorp\KongAdminApi\AbstractNode::post
     */
    public function testAddANode()
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

        // stub `delete` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo('/cluster'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->addANode($document);
    }

    /**
     * test forcibly remove a node
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\ClusterNode::forciblyRemoveANode
     * @covers \Unikorp\KongAdminApi\AbstractNode::delete
     */
    public function testForciblyRemoveANode()
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

        // stub `delete` method from `http client` mock
        $this->httpClient->expects($this->once())
            ->method('delete')
            ->with(
                $this->equalTo('/cluster'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->forciblyRemoveANode($document);
    }
}
