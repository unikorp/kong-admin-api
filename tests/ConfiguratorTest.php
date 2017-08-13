<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Tests;

use Unikorp\KongAdminApi\Configurator;
use Unikorp\KongAdminApi\Node;
use PHPUnit\Framework\TestCase;

/**
 * configurator test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ConfiguratorTest extends TestCase
{
    /**
     * configurator
     * @var \Unikorp\KongAdminApi\Configurator $configurator
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
        $this->configurator = new Configurator();
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
        $this->configurator = null;
    }

    /**
     * test construct set nodes
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::__construct
     */
    public function testConstructSetNodes()
    {
        // reflect `configurator`
        $reflectionClass = new \ReflectionClass($this->configurator);

        // set `nodes` property from `configurator` accessible
        $reflectionProperty = $reflectionClass->getProperty('nodes');
        $reflectionProperty->setAccessible(true);

        // assert
        $nodes = $reflectionProperty->getValue($this->configurator);
        $this->assertArrayHasKey('api', $nodes);
        $this->assertArrayHasKey('certificate', $nodes);
        $this->assertArrayHasKey('cluster', $nodes);
        $this->assertArrayHasKey('consumer', $nodes);
        $this->assertArrayHasKey('information', $nodes);
        $this->assertArrayHasKey('plugin', $nodes);
        $this->assertArrayHasKey('sni', $nodes);
        $this->assertArrayHasKey('target', $nodes);
        $this->assertArrayHasKey('upstream', $nodes);
        $this->assertSame(Node\Api::class, $nodes['api']);
        $this->assertSame(Node\Certificate::class, $nodes['certificate']);
        $this->assertSame(Node\Cluster::class, $nodes['cluster']);
        $this->assertSame(Node\Consumer::class, $nodes['consumer']);
        $this->assertSame(Node\Information::class, $nodes['information']);
        $this->assertSame(Node\Plugin::class, $nodes['plugin']);
        $this->assertSame(Node\Sni::class, $nodes['sni']);
        $this->assertSame(Node\Target::class, $nodes['target']);
        $this->assertSame(Node\Upstream::class, $nodes['upstream']);
    }

    /**
     * test set base uri
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::setBaseUri
     */
    public function testSetBaseUri()
    {
        // assert
        $this->configurator->setBaseUri('http://example.com:8001/test');
        $this->assertSame('http://example.com:8001/test', $this->readAttribute($this->configurator, 'baseUri'));
    }

    /**
     * test get base uri
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::getBaseUri
     */
    public function testGetBaseUri()
    {
        // reflect `configurator`
        $reflectionClass = new \ReflectionClass($this->configurator);

        // set `base uri` property from `configurator` accessible
        $reflectionProperty = $reflectionClass->getProperty('baseUri');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->configurator, 'http://example.com:8001/test');
        $this->assertSame('http://example.com:8001/test', $this->configurator->getBaseUri());
    }

    /**
     * test set headers
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::setHeaders
     */
    public function testSetHeaders()
    {
        // assert
        $this->configurator->setHeaders([
            'Test' => 'test',
        ]);
        $this->assertSame([
            'Test' => 'test',
        ], $this->readAttribute($this->configurator, 'headers'));
    }

    /**
     * test get headers
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::getHeaders
     */
    public function testGetHeaders()
    {
        // reflect `configurator`
        $reflectionClass = new \ReflectionClass($this->configurator);

        // set `base uri` property from `configurator` accessible
        $reflectionProperty = $reflectionClass->getProperty('headers');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->configurator, [
            'Test' => 'test',
        ]);
        $this->assertSame([
            'Test' => 'test',
        ], $this->configurator->getHeaders());
    }

    /**
     * test add node
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::addNode
     */
    public function testAddNode()
    {
        // reflect `configurator`
        $reflectionClass = new \ReflectionClass($this->configurator);

        // set `nodes` property from `configurator` accessible
        $reflectionProperty = $reflectionClass->getProperty('nodes');
        $reflectionProperty->setAccessible(true);

        // add node
        $this->configurator->addNode('test', '\Unikorp\KongAdminApi\Node\Information');

        // assert
        $nodes = $reflectionProperty->getValue($this->configurator);
        $this->assertArrayHasKey('test', $nodes);
        $this->assertSame('\Unikorp\KongAdminApi\Node\Information', $nodes['test']);
    }

    /**
     * test add node when already exists
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::addNode
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Node for key `api` already exists
     */
    public function testAddNodeWhenAlreadyExists()
    {
        $this->configurator->addNode('api', '\Unikorp\KongAdminApi\Node\Api');
    }

    /**
     * test add node when class does not exists
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::addNode
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Node class `\Some\Class` does not exists
     */
    public function testAddNodeWhenClassDoesNotExists()
    {
        $this->configurator->addNode('test', '\Some\Class');
    }

    /**
     * test remove node
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::removeNode
     */
    public function testRemoveNode()
    {
        // reflect `configurator`
        $reflectionClass = new \ReflectionClass($this->configurator);

        // set `nodes` property from `configurator` accessible
        $reflectionProperty = $reflectionClass->getProperty('nodes');
        $reflectionProperty->setAccessible(true);

        // add node
        $this->configurator->removeNode('api');

        // assert
        $this->assertFalse(array_key_exists('api', $reflectionProperty->getValue($this->configurator)));
    }

    /**
     * test get node when valid name
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::getNode
     */
    public function testGetNodeWhenValidName()
    {
        $this->assertSame(Node\Api::class, $this->configurator->getNode('api'));
    }

    /**
     * test get node when invalid name
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Configurator::getNode
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Node for key `invalid` does not exists
     */
    public function testGetNodeWhenInvalidName()
    {
        $this->configurator->getNode('invalid');
    }
}
