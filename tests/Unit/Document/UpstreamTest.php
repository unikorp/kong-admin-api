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

use Unikorp\KongAdminApi\Document\Upstream as Document;
use PHPUnit\Framework\TestCase;

/**
 * upstream test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class UpstreamTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\Upstream $document
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
     * @covers \Unikorp\KongAdminApi\Document\Upstream::setName
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
     * @covers \Unikorp\KongAdminApi\Document\Upstream::getName
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
     * @covers \Unikorp\KongAdminApi\Document\Upstream::setSlots
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
     * @covers \Unikorp\KongAdminApi\Document\Upstream::getSlots
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
     * @covers \Unikorp\KongAdminApi\Document\Upstream::setOrderlist
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
     * @covers \Unikorp\KongAdminApi\Document\Upstream::getOrderlist
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
     * test to json
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toJson
     * @covers \Unikorp\KongAdminApi\Document\Upstream::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setName('name')
            ->setSlots(65536)
            ->setOrderlist([1, 2, 7, 9, 6, 3]);

        $this->assertSame(
            '{"name":"name","slots":65536,"orderlist":[1,2,7,9,6,3]}',
            $this->document->toJson()
        );
    }
}
