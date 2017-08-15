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
use Unikorp\KongAdminApi\Document\ApiDocument;
use Unikorp\KongAdminApi\Document\PluginDocument as Document;
use Unikorp\KongAdminApi\Node\PluginNode as Node;

/**
 * plugin test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class PluginNodeTest extends TestCase
{
    /**
     * client
     * @param \Unikorp\KongAdminApi\Client $client
     */
    private $client = null;

    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\PluginNode $node
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
        $this->client = new Client($configurator);

        // get node
        $this->node = $this->client->getNode('plugin');

        // fixture: add api
        $document = new ApiDocument();
        $document
            ->setName('TestApi')
            ->setHosts('test.api')
            ->setUpstreamUrl('http://test.api');
        $this->client->getNode('api')->addApi($document);

        // fixture: add plugins
        $document = new Document();
        $document
            ->setName('rate-limiting')
            ->addConfig('second', 5)
            ->addConfig('hour', 10000);
        $this->node->addPlugin('TestApi', $document);

        $document = new Document();
        $document
            ->setName('datadog')
            ->addConfig('host', '127.0.0.1')
            ->addConfig('port', 8125)
            ->addConfig('timeout', 1000);
        $this->node->addPlugin('TestApi', $document);
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
        // remove plugins
        $plugins = json_decode($this->node->listPluginsPerApi('TestApi')->getBody()->getContents(), true)['data'];
        array_walk($plugins, function ($plugin) {
            $this->node->deletePlugin('TestApi', $plugin['id']);
        });

        // remove apis
        $apis = json_decode($this->client->getNode('api')->listApis()->getBody()->getContents(), true)['data'];
        array_walk($apis, function ($api) {
            $this->client->getNode('api')->deleteApi($api['name']);
        });

        // reset node & client
        $this->node = null;
        $this->client = null;
    }

    /**
     * test add plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\PluginNode::addPlugin
     */
    public function testAddPlugin()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('basic-auth')
            ->addConfig('hide_credentials', true);

        // assert
        $response = $this->node->addPlugin('TestApi', $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'basic-auth',
            'config' => [
                'hide_credentials' => true,
            ],
        ], $data);
    }

    /**
     * test retrieve plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\PluginNode::retrievePlugin
     */
    public function testRetrievePlugin()
    {
        // get a plugin id
        $pluginId = json_decode($this->node->listAllPlugins()->getBody()->getContents(), true)['data'][0]['id'];

        // assert
        $response = $this->node->retrievePlugin($pluginId);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'rate-limiting',
            'config' => [
                'second' => 5,
                'hour' => 10000,
            ],
        ], $data);
    }

    /**
     * test list all plugins
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\PluginNode::listAllPlugins
     */
    public function testListAllPlugins()
    {
        // get plugin id
        $pluginId = json_decode($this->node->listAllPlugins()->getBody()->getContents(), true)['data'][0]['id'];

        // prepare document
        $document = new Document();
        $document
            ->setSize(1)
            ->setOffset($pluginId);

        // assert
        $response = $this->node->listAllPlugins($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 2,
            'data' => [
                [
                    'id' => $pluginId,
                ],
            ],
        ], $data);
        $this->assertCount(1, $data['data']);
    }

    /**
     * test list plugins per api
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\PluginNode::listPluginsPerApi
     */
    public function testListPluginsPerApi()
    {
        // assert
        $response = $this->node->listPluginsPerApi('TestApi');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 2,
            'data' => [
            ],
        ], $data);
    }

    /**
     * test update plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\PluginNode::updatePlugin
     */
    public function testUpdatePlugin()
    {
        // get a plugin id
        $pluginId = json_decode($this->node->listPluginsPerApi('TestApi')->getBody()->getContents(), true)['data'][0]['id'];

        // prepare document
        $document = new Document();
        $document
            ->setName('rate-limiting')
            ->addConfig('second', 10)
            ->addConfig('hour', 5000);

        // assert
        $response = $this->node->updatePlugin('TestApi', $pluginId, $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'rate-limiting',
            'config' => [
                'second' => 10,
                'hour' => 5000,
            ],
        ], $data);
    }

    /**
     * test update or add plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\PluginNode::updateOrAddPlugin
     */
    public function testUpdateOrAddPlugin()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('cors')
            ->addConfig('origins', 'mockbin.com')
            ->addConfig('methods', 'GET, POST')
            ->addConfig('headers', 'Accept, Accept-Version, Content-Length, Content-MD5, Content-Type, Date, X-Auth-Token')
            ->addConfig('exposed_headers', 'X-Auth-Token')
            ->addConfig('credentials', true)
            ->addConfig('max_age', 3600);

        // assert
        $response = $this->node->updateOrAddPlugin('TestApi', $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'cors',
            'config' => [
                'origins' => [
                    'mockbin.com',
                ],
                'methods' => [
                    'GET',
                    'POST',
                ],
                'headers' => [
                    'Accept',
                    'Accept-Version',
                    'Content-Length',
                    'Content-MD5',
                    'Content-Type',
                    'Date',
                    'X-Auth-Token',
                ],
                'exposed_headers' => [
                    'X-Auth-Token',
                ],
                'credentials' => true,
                'max_age' => 3600,
            ],
        ], $data);
    }

    /**
     * test delete plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\PluginNode::deletePlugin
     */
    public function testDeletePlugin()
    {
        // get a plugin id
        $pluginId = json_decode($this->node->listPluginsPerApi('TestApi')->getBody()->getContents(), true)['data'][0]['id'];

        // assert
        $response = $this->node->deletePlugin('TestApi', $pluginId);

        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame('No Content', $response->getReasonPhrase());
    }

    /**
     * test retrieve enabled plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\PluginNode::retrieveEnabledPlugin
     */
    public function testRetrieveEnabledPlugin()
    {
        // assert
        $response = $this->node->retrieveEnabledPlugin();
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'enabled_plugins' => [
                'syslog',
                'ldap-auth',
                'rate-limiting',
                'correlation-id',
                'jwt',
                'request-termination',
                'runscope',
                'request-transformer',
                'http-log',
                'loggly',
                'response-transformer',
                'basic-auth',
                'tcp-log',
                'hmac-auth',
                'oauth2',
                'acl',
                'bot-detection',
                'udp-log',
                'cors',
                'file-log',
                'ip-restriction',
                'datadog',
                'request-size-limiting',
                'galileo',
                'aws-lambda',
                'statsd',
                'response-ratelimiting',
                'key-auth',
            ],
        ], $data);
    }

    /**
     * test retrieve plugin schema
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\PluginNode::retrievePluginSchema
     */
    public function testRetrievePluginSchema()
    {
        // assert
        $response = $this->node->retrievePluginSchema('basic-auth');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'fields' => [
                'anonymous' => [
                    'type' => 'string',
                    'func' => 'function',
                    'default' => '',
                ],
                'hide_credentials' => [
                    'type' => 'boolean',
                    'default' => false,
                ]
            ],
            'no_consumer' => true,
        ], $data);
    }
}
