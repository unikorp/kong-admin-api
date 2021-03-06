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

use Unikorp\KongAdminApi\Document\SniDocument as Document;
use PHPUnit\Framework\TestCase;

/**
 * sni document test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class SniDocumentTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\SniDocument $document
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
     * @covers \Unikorp\KongAdminApi\Document\SniDocument::setName
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
     * @covers \Unikorp\KongAdminApi\Document\SniDocument::getName
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
     * test set ssl certificate id
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\SniDocument::setSslCertificateId
     */
    public function testSetSslCertificateId()
    {
        // asserts
        $this->document->setSslCertificateId('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'sslCertificateId'));
    }

    /**
     * test get ssl certificate id
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\SniDocument::getSslCertificateId
     */
    public function testGetSslCertificateId()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `sslCertificateId` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('sslCertificateId');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getSslCertificateId());
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
     * @covers \Unikorp\KongAdminApi\Document\SniDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setName('name')
            ->setSslCertificateId('sslCertificateId')
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            '{"name":"name","ssl_certificate_id":"sslCertificateId","created_at":42,"size":50,"offset":"offset"}',
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
     * @covers \Unikorp\KongAdminApi\Document\SniDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToQueryString()
    {
        $this->document
            ->setName('name')
            ->setSslCertificateId('sslCertificateId')
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            'name=name&ssl_certificate_id=sslCertificateId&created_at=42&size=50&offset=offset',
            $this->document->toQueryString()
        );
    }
}
