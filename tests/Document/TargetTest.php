<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Tests\Document;

use Unikorp\KongAdminApi\Document\Target as Document;
use PHPUnit\Framework\TestCase;

/**
 * target test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class TargetTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\Target $document
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
     * test set target
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Target::setTarget
     */
    public function testSetTarget()
    {
        // asserts
        $this->document->setTarget('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'target'));
    }

    /**
     * test get target
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Target::getTarget
     */
    public function testGetTarget()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `name` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('target');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getTarget());
    }

    /**
     * test set weight
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Target::setWeight
     */
    public function testSetWeight()
    {
        // asserts
        $this->document->setWeight(1000);
        $this->assertSame(1000, $this->readAttribute($this->document, 'weight'));
    }

    /**
     * test get weight
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Target::getWeight
     */
    public function testGetWeight()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `name` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('weight');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 1000);
        $this->assertSame(1000, $this->document->getWeight());
    }

    /**
     * test to json
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toJson
     * @covers \Unikorp\KongAdminApi\Document\Target::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setTarget('target')
            ->setWeight(1000);

        $this->assertSame(
            '{"target":"target","weight":1000}',
            $this->document->toJson()
        );
    }
}
