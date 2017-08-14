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

use Unikorp\KongAdminApi\Node\Plugin as Node;
use PHPUnit\Framework\TestCase;

/**
 * plugin test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class PluginTest extends TestCase
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
     * test add plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Plugin::addPlugin
     * @covers \Unikorp\KongAdminApi\AbstractNode::post
     */
    public function testAddPlugin()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `document`
        $document = $this->createMock('\Unikorp\KongAdminApi\Document\Plugin');

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
                $this->equalTo('/apis/test-plugin/plugins/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->addPlugin('test-plugin', $document);
    }

    /**
     * test retrieve plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Plugin::retrievePlugin
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testRetrievePlugin()
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
            ->with($this->equalTo('/plugins/test-plugin'))
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->retrievePlugin('test-plugin');
    }

    /**
     * test list all plugins
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Plugin::listAllPlugins
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testListAllPlugins()
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
            ->with($this->equalTo('/plugins/'))
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->listAllPlugins();
    }

    /**
     * test list plugins per api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Plugin::listPluginsPerApi
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testListPluginsPerApi()
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
            ->with($this->equalTo('/apis/test-api/plugins/'))
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->listPluginsPerApi('test-api');
    }

    /**
     * test update plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Plugin::updatePlugin
     * @covers \Unikorp\KongAdminApi\AbstractNode::patch
     */
    public function testUpdatePlugin()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `document`
        $document = $this->createMock('\Unikorp\KongAdminApi\Document\Plugin');

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
                $this->equalTo('/apis/test-api/plugins/id-plugin'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updatePlugin('test-api', 'id-plugin', $document);
    }

    /**
     * test update or add plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Plugin::updateOrAddPlugin
     * @covers \Unikorp\KongAdminApi\AbstractNode::put
     */
    public function testUpdateOrAddPlugin()
    {
        // stub `get http client` method from `client` mock
        $this->client->expects($this->once())
            ->method('getHttpClient')
            ->will($this->returnValue($this->httpClient));

        // mock `document`
        $document = $this->createMock('\Unikorp\KongAdminApi\Document\Plugin');

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
                $this->equalTo('/apis/test-api/plugins/'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('{"test":true}')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->updateOrAddPlugin('test-api', $document);
    }

    /**
     * test delete plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Plugin::deletePlugin
     * @covers \Unikorp\KongAdminApi\AbstractNode::delete
     */
    public function testDeletePlugin()
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
                $this->equalTo('/apis/test-api/plugins/id-plugin'),
                $this->equalTo(['Content-Type' => 'application/json']),
                $this->equalTo('[]')
            )
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->deletePlugin('test-api', 'id-plugin');
    }

    /**
     * test retrieve enabled plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Plugin::retrieveEnabledPlugin
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testRetrieveEnabledPlugin()
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
            ->with($this->equalTo('/plugins/enabled'))
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->retrieveEnabledPlugin();
    }

    /**
     * test retrieve plugin schema
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Plugin::retrievePluginSchema
     * @covers \Unikorp\KongAdminApi\AbstractNode::get
     */
    public function testRetrievePluginSchema()
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
            ->with($this->equalTo('/plugins/schema/test-plugin'))
            ->will($this->returnValue($response));

        $node = new Node($this->client);
        $node->retrievePluginSchema('test-plugin');
    }
}
