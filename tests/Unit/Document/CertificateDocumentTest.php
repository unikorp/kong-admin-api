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

use Unikorp\KongAdminApi\Document\CertificateDocument as Document;
use PHPUnit\Framework\TestCase;

/**
 * certificate document test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class CertificateDocumentTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\CertificateDocument $document
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
     * test set cert
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\CertificateDocument::setCert
     */
    public function testSetCert()
    {
        // asserts
        $this->document->setCert('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'cert'));
    }

    /**
     * test get cert
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\CertificateDocument::getCert
     */
    public function testGetCert()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `cert` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('cert');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getCert());
    }

    /**
     * test set key
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\CertificateDocument::setKey
     */
    public function testSetKey()
    {
        // asserts
        $this->document->setKey('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'key'));
    }

    /**
     * test get key
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\CertificateDocument::getKey
     */
    public function testGetKey()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `key` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('key');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getKey());
    }

    /**
     * test set snis
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\CertificateDocument::setSnis
     */
    public function testSetSnis()
    {
        // asserts
        $this->document->setSnis('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'snis'));
    }

    /**
     * test get snis
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\CertificateDocument::getSnis
     */
    public function testGetSnis()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `snis` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('snis');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getSnis());
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
     * @covers \Unikorp\KongAdminApi\Document\CertificateDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setCert('cert')
            ->setKey('key')
            ->setSnis('snis')
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            '{"cert":"cert","key":"key","snis":"snis","created_at":42,"size":50,"offset":"offset"}',
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
     * @covers \Unikorp\KongAdminApi\Document\CertificateDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToQueryString()
    {
        $this->document
            ->setCert('cert')
            ->setKey('key')
            ->setSnis('snis')
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            'cert=cert&key=key&snis=snis&created_at=42&size=50&offset=offset',
            $this->document->toQueryString()
        );
    }
}
