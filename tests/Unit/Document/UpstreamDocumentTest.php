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

use Unikorp\KongAdminApi\Document\UpstreamDocument as Document;
use PHPUnit\Framework\TestCase;

/**
 * upstream document test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class UpstreamDocumentTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\UpstreamDocument $document
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
     * @covers \Unikorp\KongAdminApi\Document\UpstreamDocument::setName
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
     * @covers \Unikorp\KongAdminApi\Document\UpstreamDocument::getName
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
     * test set slots
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\UpstreamDocument::setSlots
     */
    public function testSetSlots()
    {
        // asserts
        $this->document->setSlots(65536);
        $this->assertSame(65536, $this->readAttribute($this->document, 'slots'));
    }

    /**
     * test get slots
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\UpstreamDocument::getSlots
     */
    public function testGetSlots()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `slots` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('slots');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 65536);
        $this->assertSame(65536, $this->document->getSlots());
    }

    /**
     * test set orderlist
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\UpstreamDocument::setOrderlist
     */
    public function testSetOrderlist()
    {
        // asserts
        $this->document->setOrderlist([1, 2, 7, 9, 6, 3]);
        $this->assertSame([1, 2, 7, 9, 6, 3], $this->readAttribute($this->document, 'orderlist'));
    }

    /**
     * test get orderlist
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\UpstreamDocument::getOrderlist
     */
    public function testGetOrderlist()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `orderlist` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('orderlist');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, [1, 2, 7, 9, 6, 3]);
        $this->assertSame([1, 2, 7, 9, 6, 3], $this->document->getOrderlist());
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
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toRequestParameters
     * @covers \Unikorp\KongAdminApi\Document\UpstreamDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setName('name')
            ->setSlots(65536)
            ->setOrderlist([1, 2, 7, 9, 6, 3])
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            '{"name":"name","slots":65536,"orderlist":[1,2,7,9,6,3],"created_at":42,"size":50,"offset":"offset"}',
            $this->document->toJson()
        );
    }

    /**
     * test to query string
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toQueryString
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toRequestParameters
     * @covers \Unikorp\KongAdminApi\Document\UpstreamDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToQueryString()
    {
        $this->document
            ->setName('name')
            ->setSlots(65536)
            ->setOrderlist([1, 2, 7, 9, 6, 3])
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            'name=name&slots=65536&orderlist%5B0%5D=1&orderlist%5B1%5D=2&orderlist%5B2%5D=7&orderlist%5B3%5D=9&orderlist%5B4%5D=6&orderlist%5B5%5D=3&created_at=42&size=50&offset=offset',
            $this->document->toQueryString()
        );
    }
}
