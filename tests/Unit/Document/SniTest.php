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

use Unikorp\KongAdminApi\Document\Sni as Document;
use PHPUnit\Framework\TestCase;

/**
 * sni test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class SniTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\Sni $document
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
     * @covers \Unikorp\KongAdminApi\Document\Sni::setName
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
     * @covers \Unikorp\KongAdminApi\Document\Sni::getName
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
     * @covers \Unikorp\KongAdminApi\Document\Sni::setSslCertificateId
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
     * @covers \Unikorp\KongAdminApi\Document\Sni::getSslCertificateId
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
     * test to json
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toJson
     * @covers \Unikorp\KongAdminApi\Document\Sni::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setName('name')
            ->setSslCertificateId('sslCertificateId')
            ->setCreatedAt(42);

        $this->assertSame(
            '{"name":"name","ssl_certificate_id":"sslCertificateId","created_at":42}',
            $this->document->toJson()
        );
    }
}
