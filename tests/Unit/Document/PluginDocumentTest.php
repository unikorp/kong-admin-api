<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Tests\Unit\Document;

use Unikorp\KongAdminApi\Document\PluginDocument as Document;
use PHPUnit\Framework\TestCase;

/**
 * plugin document test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class PluginDocumentTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\PluginDocument $document
     */
    private $document = null;

    /**
     * set up
     *
     * @return void
     *
     * @coversNothing
     */
    protected function setUp()
    {
        $this->document = new Document();
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
        $this->document = null;
    }

    /**
     * test set name
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::setName
     */
    public function testSetName()
    {
        // asserts
        $this->document->setName('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'name'));
    }

    /**
     * test get name
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::getName
     */
    public function testGetName()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `name` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('name');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getName());
    }

    /**
     * test set consumer id
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::setConsumerId
     */
    public function testSetConsumerId()
    {
        // asserts
        $this->document->setConsumerId('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'consumerId'));
    }

    /**
     * test get consumer id
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::getConsumerId
     */
    public function testGetConsumerId()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `consumer id` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('consumerId');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getConsumerId());
    }

    /**
     * test add config
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::addConfig
     */
    public function testAddConfig()
    {
        // assert
        $this->document
            ->addConfig('test', 'test')
            ->addConfig('something_else', 'something_else');
        $this->assertSame(
            ['test' => 'test', 'something_else' => 'something_else'],
            $this->readAttribute($this->document, 'config')
        );
    }

    /**
     * test add config when name already set
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::addConfig
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Config for name `test` already set
     */
    public function testAddConfigWhenNameAlreadySet()
    {
        // assert
        $this->document
            ->addConfig('test', 'first')
            ->addConfig('test', 'second');
    }

    /**
     * test remove config
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::removeConfig
     */
    public function testRemoveConfig()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `config` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('config');
        $reflectionProperty->setAccessible(true);

        $reflectionProperty->setValue(
            $this->document,
            ['test' => 'test', 'something_else' => 'something_else']
        );

        // assert
        $this->document->removeConfig('test');
        $this->assertSame(['something_else' => 'something_else'], $this->readAttribute($this->document, 'config'));
    }

    /**
     * test get config
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::getConfig
     */
    public function testGetConfig()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `config` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('config');
        $reflectionProperty->setAccessible(true);

        $reflectionProperty->setValue($this->document, ['test' => 'test']);

        // assert
        $this->assertSame('test', $this->document->getConfig('test'));
    }

    /**
     * test set created at
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::setCreatedAt
     */
    public function testSetCreatedAt()
    {
        // asserts
        $this->document->setCreatedAt(42);
        $this->assertSame(42, $this->readAttribute($this->document, 'createdAt'));
    }

    /**
     * test get created at
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::getCreatedAt
     */
    public function testGetCreatedAt()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `created at` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('createdAt');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 42);
        $this->assertSame(42, $this->document->getCreatedAt());
    }

    /**
     * test set size
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::setSize
     */
    public function testSetSize()
    {
        // asserts
        $this->document->setSize(42);
        $this->assertSame(42, $this->readAttribute($this->document, 'size'));
    }

    /**
     * test get size
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::getSize
     */
    public function testGetSize()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `size` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('size');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 42);
        $this->assertSame(42, $this->document->getSize());
    }


    /**
     * test set offset
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::setOffset
     */
    public function testSetOffset()
    {
        // asserts
        $this->document->setOffset('offset');
        $this->assertSame('offset', $this->readAttribute($this->document, 'offset'));
    }

    /**
     * test get offset
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::getOffset
     */
    public function testGetOffset()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `offset` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('offset');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'offset');
        $this->assertSame('offset', $this->document->getOffset());
    }

    /**
     * test to json
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toJson
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::toRequestParameters
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setName('name')
            ->setConsumerId('consumerId')
            ->addConfig('test', true)
            ->addConfig('something_else', 'something_else')
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            '{"name":"name","consumer_id":"consumerId","config.test":true,"config.something_else":"something_else","created_at":42,"size":50,"offset":"offset"}',
            $this->document->toJson()
        );
    }

    /**
     * test to query string
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toQueryString
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::toRequestParameters
     * @covers \Unikorp\KongAdminApi\Document\PluginDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToQueryString()
    {
        $this->document
            ->setName('name')
            ->setConsumerId('consumerId')
            ->addConfig('test', true)
            ->addConfig('something_else', 'something_else')
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            'name=name&consumer_id=consumerId&config.test=1&config.something_else=something_else&created_at=42&size=50&offset=offset',
            $this->document->toQueryString()
        );
    }
}
