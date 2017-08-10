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

use Unikorp\KongAdminApi\Document\Certificate as Document;
use PHPUnit\Framework\TestCase;

/**
 * certificate test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class CertificateTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\Certificate $document
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
     * @covers \Unikorp\KongAdminApi\Document\Certificate::setCert
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
     * @covers \Unikorp\KongAdminApi\Document\Certificate::getCert
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
     * @covers \Unikorp\KongAdminApi\Document\Certificate::setKey
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
     * @covers \Unikorp\KongAdminApi\Document\Certificate::getKey
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
     * @covers \Unikorp\KongAdminApi\Document\Certificate::setSnis
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
     * @covers \Unikorp\KongAdminApi\Document\Certificate::getSnis
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
     * test to json
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toJson
     * @covers \Unikorp\KongAdminApi\Document\Certificate::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setCert('cert')
            ->setKey('key')
            ->setSnis('snis');

        $this->assertSame(
            '{"cert":"cert","key":"key","snis":"snis"}',
            $this->document->toJson()
        );
    }
}
