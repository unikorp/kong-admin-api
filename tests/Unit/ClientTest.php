<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Tests\Unit;

use Unikorp\KongAdminApi\Client;
use PHPUnit\Framework\TestCase;

/**
 * client test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ClientTest extends TestCase
{
    /**
     * configurator
     * @var \Unikorp\KongAdminApi\ConfiguratorInterface $configurator
     */
    private $configurator = null;

    /**
     * set up
     *
     * @return void
     *
     * @coversNothing
     */
    public function setUp()
    {
        // mock `configurator`
        $this->configurator = $this->createMock('\Unikorp\KongAdminApi\ConfiguratorInterface');

        // stub `get base uri` method from `configurator` mock
        $this->configurator->expects($this->once())
            ->method('getBaseUri')
            ->will($this->returnValue('http://example.com:8001/test'));

        // stub `get base uri` method from `configurator` mock
        $this->configurator->expects($this->once())
            ->method('getHeaders')
            ->will($this->returnValue([
                'Test' => 'test',
            ]));
    }

    /**
     * tear down
     *
     * @return void
     *
     * @coversNothing
     */
    public function tearDown()
    {
        // tear down `configurator`
        $this->configurator = null;
    }

    /**
     * test construct set http client
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Client::__construct
     */
    public function testConstructSetHttpClient()
    {
        // create new `client`
        $client = new Client($this->configurator);

        // reflect `client`
        $reflectionClass = new \ReflectionClass($client);

        // set `http client` property from `client` accessible
        $reflectionProperty = $reflectionClass->getProperty('httpClient');
        $reflectionProperty->setAccessible(true);

        // asserts
        $this->assertInstanceOf('\Http\Client\HttpClient', $reflectionProperty->getValue($client));
    }

    /**
     * test construct set message factory
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Client::__construct
     */
    public function testConstructSetMessageFactory()
    {
        // create new `client`
        $client = new Client($this->configurator);

        // reflect `client`
        $reflectionClass = new \ReflectionClass($client);

        // set `message factory` property from `client` accessible
        $reflectionProperty = $reflectionClass->getProperty('messageFactory');
        $reflectionProperty->setAccessible(true);

        // asserts
        $this->assertInstanceOf('\Http\Message\MessageFactory', $reflectionProperty->getValue($client));
    }

    /**
     * test construct add host plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Client::__construct
     */
    public function testConstructAddAddHostPlugin()
    {
        // create new `client`
        $client = new Client($this->configurator);

        // get `add host plugin`
        $plugin = $this->readAttribute($client, 'plugins')[0];

        // get `host`
        $host = $this->readAttribute($plugin, 'host');

        // asserts
        $this->assertInstanceOf('\Http\Client\Common\Plugin\AddHostPlugin', $plugin);
        $this->assertSame('http://example.com:8001/test', (string) $host);
    }

    /**
     * test construct add header set plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Client::__construct
     */
    public function testConstructAddHeaderSetPlugin()
    {
        // create new `client`
        $client = new Client($this->configurator);

        // get `add host plugin`
        $plugin = $this->readAttribute($client, 'plugins')[1];

        // get `headers`
        $headers = $this->readAttribute($plugin, 'headers');

        // asserts
        $this->assertInstanceOf('\Http\Client\Common\Plugin\HeaderSetPlugin', $plugin);
        $this->assertSame([
            'Test' => 'test',
        ], $headers);
    }

    /**
     * test get node when valid
     *
     * @param string $name
     * @param string $class
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Client::getNode
     * @dataProvider validNodeNameProvider
     */
    public function testGetNodeWhenValid($name, $class)
    {
        // stub `get node` method from `configurator` mock
        $this->configurator->expects($this->once())
            ->method('getNode')
            ->with($this->equalTo($name))
            ->will($this->returnValue($class));

        // create new `client`
        $client = new Client($this->configurator);

        // assert
        $this->assertInstanceOf($class, $client->getNode($name));
    }

    /**
     * test get node when invalid
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Client::getNode
     * @expectedException \RuntimeException
     * @expectedExceptionMessage
     */
    public function testGetNodeWhenInvalid()
    {
        // stub `get node` method from `configurator` mock
        $this->configurator->expects($this->once())
            ->method('getNode')
            ->with($this->equalTo('something'))
            ->will($this->throwException(new \RuntimeException()));

        // create new `client`
        $client = new Client($this->configurator);

        // assert
        $client->getNode('something');
    }

    /**
     * test add plugin
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Client::addPlugin
     */
    public function testAddPlugin()
    {
        // create new `client`
        $client = new Client($this->configurator);

        // mock `plugin`
        $plugin = $this->createMock('\Http\Client\Common\Plugin');

        // set `plugins` property from `client` accessible
        $reflectionClass = new \ReflectionClass($client);
        $reflectionProperty = $reflectionClass->getProperty('plugins');
        $reflectionProperty->setAccessible(true);

        // add `plugin`
        $this->assertSame($client, $client->addPlugin($plugin));

        // assert
        $this->assertContains($plugin, $reflectionProperty->getValue($client));
    }

    /**
     * test get http client
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Client::getHttpClient
     */
    public function testGetHttpClient()
    {
        // create new `client`
        $client = new Client($this->configurator);

        // asert
        $this->assertInstanceOf('\Http\Client\Common\HttpMethodsClient', $client->getHttpClient());
    }

    /**
     * valid node name provider
     *
     * @return array
     */
    public function validNodeNameProvider()
    {
        yield ['api', '\Unikorp\KongAdminApi\Node\Api'];
        yield ['cluster', '\Unikorp\KongAdminApi\Node\Cluster'];
        yield ['consumer', '\Unikorp\KongAdminApi\Node\Consumer'];
        yield ['information', '\Unikorp\KongAdminApi\Node\Information'];
        yield ['plugin', '\Unikorp\KongAdminApi\Node\Plugin'];
    }
}
