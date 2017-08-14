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

use Unikorp\KongAdminApi\Document\Cluster as Document;
use PHPUnit\Framework\TestCase;

/**
 * cluster test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ClusterTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\Cluster $document
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
     * @covers \Unikorp\KongAdminApi\Document\Cluster::setName
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
     * @covers \Unikorp\KongAdminApi\Document\Cluster::getName
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
     * test set address
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Cluster::setAddress
     */
    public function testSetAddress()
    {
        // asserts
        $this->document->setAddress('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'address'));
    }

    /**
     * test get address
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Cluster::getAddress
     */
    public function testGetAddress()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `address` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('address');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getAddress());
    }

    /**
     * test to json
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toJson
     * @covers \Unikorp\KongAdminApi\Document\Cluster::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setName('name')
            ->setAddress('address');

        $this->assertSame('{"name":"name","address":"address"}', $this->document->toJson());
    }
}
