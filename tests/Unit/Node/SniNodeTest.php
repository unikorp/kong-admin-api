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

use Unikorp\KongAdminApi\Document\SniDocument as Document;
use Unikorp\KongAdminApi\Node\SniNode as Node;
use PHPUnit\Framework\TestCase;

/**
 * sni node test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class SniNodeTest extends TestCase
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
     * test add sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::addSni
     * @covers \Unikorp\KongAdminApi\AbstractNode::post
     */
    public function testAddSni()
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
                $this->equalTo('/snis/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->addSni($document);
    }

    /**
     * test retrieve sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::retrieveSni
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testRetrieveSni()
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
                $this->equalTo('/snis/test-sni?'),
                $this->equalTo(['Content-Type' => 'application/x-www-form-urlencoded'])
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->retrieveSni('test-sni');
    }

    /**
     * test list snis
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::listSnis
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testListSnis()
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
                $this->equalTo('/snis/?'),
                $this->equalTo(['Content-Type' => 'application/x-www-form-urlencoded'])
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->listSnis();
    }

    /**
     * test update sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::updateSni
     * @covers \Unikorp\KongAdminApi\AbstractNode::patch
     */
    public function testUpdateSni()
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
                $this->equalTo('/snis/test-sni'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updateSni('test-sni', $document);
    }

    /**
     * test update or create sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::updateOrCreateSni
     * @covers \Unikorp\KongAdminApi\AbstractNode::put
     */
    public function testUpdateOrCreateSni()
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
                $this->equalTo('/snis/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updateOrCreateSni($document);
    }

    /**
     * test delete sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::deleteSni
     * @covers \Unikorp\KongAdminApi\AbstractNode::delete
     */
    public function testDeleteSni()
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
                $this->equalTo('/snis/test-sni'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('[]')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->deleteSni('test-sni');
    }
}
