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

use Unikorp\KongAdminApi\Document\Consumer as Document;
use PHPUnit\Framework\TestCase;

/**
 * consumer test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ConsumerTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\Consumer $document
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
     * test set username
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Consumer::setUsername
     */
    public function testSetUsername()
    {
        // asserts
        $this->document->setUsername('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'username'));
    }

    /**
     * test get username
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Consumer::getUsername
     */
    public function testGetUsername()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `username` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('username');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getUsername());
    }

    /**
     * test set custom id
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Consumer::setCustomId
     */
    public function testCustomId()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `custom id` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('customId');
        $reflectionProperty->setAccessible(true);

        // asserts
        $this->document->setCustomId('test');
        $this->assertSame('test', $reflectionProperty->getValue($this->document));
    }

    /**
     * test get custom id
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Consumer::getCustomId
     */
    public function testGetCustomId()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `custom id` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('customId');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getCustomId());
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
     * test to json
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toJson
     * @covers \Unikorp\KongAdminApi\Document\Consumer::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setUsername('username')
            ->setCustomId('customId')
            ->setCreatedAt(42);

        $this->assertSame('{"username":"username","custom_id":"customId","created_at":42}', $this->document->toJson());
    }
}
