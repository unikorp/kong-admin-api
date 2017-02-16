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

use Unikorp\KongAdminApi\Document\Api as Document;
use PHPUnit\Framework\TestCase;

/**
 * api test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ApiTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\Api $document
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
     * @covers \Unikorp\KongAdminApi\Document\Api::setName
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
     * @covers \Unikorp\KongAdminApi\Document\Api::getName
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
     * test set request host
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::setRequestHost
     */
    public function testSetRequestHost()
    {
        // asserts
        $this->document->setRequestHost('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'requestHost'));
    }

    /**
     * test get request host
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::getRequestHost
     */
    public function testGetRequestHost()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `request host` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('requestHost');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getRequestHost());
    }

    /**
     * test set request path
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::setRequestPath
     */
    public function testSetRequestPath()
    {
        // asserts
        $this->document->setRequestPath('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'requestPath'));
    }

    /**
     * test get request path
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::getRequestPath
     */
    public function testGetRequestPath()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `request path` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('requestPath');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getRequestPath());
    }

    /**
     * test set strip request path
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::setStripRequestPath
     */
    public function testSetStripRequestPath()
    {
        // asserts
        $this->document->setStripRequestPath(true);
        $this->assertSame(true, $this->readAttribute($this->document, 'stripRequestPath'));
    }

    /**
     * test get strip request path
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::getStripRequestPath
     */
    public function testGetStripRequestPath()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `strip request path` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('stripRequestPath');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, true);
        $this->assertSame(true, $this->document->getStripRequestPath());
    }

    /**
     * test set preserve host
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::setPreserveHost
     */
    public function testSetPreserveHost()
    {
        // asserts
        $this->document->setPreserveHost(true);
        $this->assertSame(true, $this->readAttribute($this->document, 'preserveHost'));
    }

    /**
     * test get preserve host
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::getPreserveHost
     */
    public function testGetPreserveHost()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `preserve host` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('preserveHost');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, true);
        $this->assertSame(true, $this->document->getPreserveHost());
    }

    /**
     * test set upstream url
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::setUpstreamUrl
     */
    public function testSetUpstreamUrl()
    {
        // asserts
        $this->document->setUpstreamUrl('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'upstreamUrl'));
    }

    /**
     * test get upstream url
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\Api::getUpstreamUrl
     */
    public function testGetUpstreamUrl()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `upstream url` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('upstreamUrl');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getUpstreamUrl());
    }

    /**
     * test to json
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toJson
     * @covers \Unikorp\KongAdminApi\Document\Api::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setName('name')
            ->setRequestHost('requestHost')
            ->setStripRequestPath(true)
            ->setPreserveHost(true)
            ->setUpstreamUrl('upstreamUrl');

        $this->assertSame(
            '{"name":"name","request_host":"requestHost","strip_request_path":true,"preserve_host":true,"upstream_url":"upstreamUrl"}',
            $this->document->toJson()
        );
    }
}
