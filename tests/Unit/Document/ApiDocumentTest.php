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

use Unikorp\KongAdminApi\Document\ApiDocument as Document;
use PHPUnit\Framework\TestCase;

/**
 * api document test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ApiDocumentTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\ApiDocument $document
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
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setName
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
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getName
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
     * test set hosts
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setHosts
     */
    public function testSetHosts()
    {
        // asserts
        $this->document->setHosts('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'hosts'));
    }

    /**
     * test get hosts
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getHosts
     */
    public function testGetHosts()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `hosts` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('hosts');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getHosts());
    }

    /**
     * test set uris
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setUris
     */
    public function testSetUris()
    {
        // asserts
        $this->document->setUris('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'uris'));
    }

    /**
     * test get uris
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getUris
     */
    public function testGetUris()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `uris` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('uris');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getUris());
    }

    /**
     * test set methods
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setMethods
     */
    public function testSetMethods()
    {
        // asserts
        $this->document->setMethods('test');
        $this->assertSame('test', $this->readAttribute($this->document, 'methods'));
    }

    /**
     * test get methods
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getMethods
     */
    public function testGetMethods()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `methods` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('methods');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 'test');
        $this->assertSame('test', $this->document->getMethods());
    }

    /**
     * test set upstream url
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setUpstreamUrl
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
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getUpstreamUrl
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
     * test set strip uri
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setStripUri
     */
    public function testSetStripUri()
    {
        // asserts
        $this->document->setStripUri(false);
        $this->assertSame(false, $this->readAttribute($this->document, 'stripUri'));
    }

    /**
     * test get strip uri
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getStripUri
     */
    public function testGetStripUri()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `strip uri` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('stripUri');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, false);
        $this->assertSame(false, $this->document->getStripUri());
    }

    /**
     * test set preserve host
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setPreserveHost
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
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getPreserveHost
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
     * test set retries
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setRetries
     */
    public function testSetRetries()
    {
        // asserts
        $this->document->setRetries(10);
        $this->assertSame(10, $this->readAttribute($this->document, 'retries'));
    }

    /**
     * test get retries
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getRetries
     */
    public function testGetRetries()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `retries` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('retries');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 10);
        $this->assertSame(10, $this->document->getRetries());
    }

    /**
     * test set upstream connect timeout
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setUpstreamConnectTimeout
     */
    public function testSetUpstreamConnectTimeout()
    {
        // asserts
        $this->document->setUpstreamConnectTimeout(10000);
        $this->assertSame(10000, $this->readAttribute($this->document, 'upstreamConnectTimeout'));
    }

    /**
     * test get upstream connect timeout
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getUpstreamConnectTimeout
     */
    public function testGetUpstreamConnectTimeout()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `upstream connect timeout` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('upstreamConnectTimeout');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 10000);
        $this->assertSame(10000, $this->document->getUpstreamConnectTimeout());
    }

    /**
     * test set upstream send timeout
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setUpstreamSendTimeout
     */
    public function testSetUpstreamSendTimeout()
    {
        // asserts
        $this->document->setUpstreamSendTimeout(10000);
        $this->assertSame(10000, $this->readAttribute($this->document, 'upstreamSendTimeout'));
    }

    /**
     * test get upstream send timeout
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getUpstreamSendTimeout
     */
    public function testGetUpstreamSendTimeout()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `upstream send timeout` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('upstreamSendTimeout');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 10000);
        $this->assertSame(10000, $this->document->getUpstreamSendTimeout());
    }

    /**
     * test set upstream read timeout
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setUpstreamReadTimeout
     */
    public function testSetUpstreamReadTimeout()
    {
        // asserts
        $this->document->setUpstreamReadTimeout(10000);
        $this->assertSame(10000, $this->readAttribute($this->document, 'upstreamReadTimeout'));
    }

    /**
     * test get upstream read timeout
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getUpstreamReadTimeout
     */
    public function testGetUpstreamReadTimeout()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `upstream send timeout` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('upstreamReadTimeout');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, 10000);
        $this->assertSame(10000, $this->document->getUpstreamReadTimeout());
    }

    /**
     * test set https only
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setHttpsOnly
     */
    public function testSetHttpsOnly()
    {
        // asserts
        $this->document->setHttpsOnly(true);
        $this->assertSame(true, $this->readAttribute($this->document, 'httpsOnly'));
    }

    /**
     * test get https only
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getHttpsOnly
     */
    public function testGetHttpsOnly()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `https only` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('httpsOnly');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, true);
        $this->assertSame(true, $this->document->getHttpsOnly());
    }

    /**
     * test set http if terminated
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::setHttpIfTerminated
     */
    public function testSetHttpIfTerminated()
    {
        // asserts
        $this->document->setHttpIfTerminated(false);
        $this->assertSame(false, $this->readAttribute($this->document, 'httpIfTerminated'));
    }

    /**
     * test get http if terminated
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getHttpIfTerminated
     */
    public function testGetHttpIfTerminated()
    {
        // reflect `document`
        $reflectionClass = new \ReflectionClass($this->document);

        // set `http if terminated` property from `document` accessible
        $reflectionProperty = $reflectionClass->getProperty('httpIfTerminated');
        $reflectionProperty->setAccessible(true);

        // assert
        $reflectionProperty->setValue($this->document, false);
        $this->assertSame(false, $this->document->getHttpIfTerminated());
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
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToJson()
    {
        $this->document
            ->setName('name')
            ->setHosts('hosts')
            ->setUris('uris')
            ->setMethods('methods')
            ->setUpstreamUrl('upstreamUrl')
            ->setStripUri(false)
            ->setPreserveHost(true)
            ->setRetries(10)
            ->setUpstreamConnectTimeout(10000)
            ->setUpstreamSendTimeout(10000)
            ->setUpstreamReadTimeout(10000)
            ->setHttpsOnly(true)
            ->setHttpIfTerminated(false)
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            '{"name":"name","hosts":"hosts","uris":"uris","methods":"methods","upstream_url":"upstreamUrl","strip_uri":false,"preserve_host":true,"retries":10,"upstream_connect_timeout":10000,"upstream_send_timeout":10000,"upstream_read_timeout":10000,"https_only":true,"http_if_terminated":false,"created_at":42,"size":50,"offset":"offset"}',
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
     * @covers \Unikorp\KongAdminApi\Document\ApiDocument::getFields
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toSnakeCase
     */
    public function testToQueryString()
    {
        $this->document
            ->setName('name')
            ->setHosts('hosts')
            ->setUris('uris')
            ->setMethods('methods')
            ->setUpstreamUrl('upstreamUrl')
            ->setStripUri(false)
            ->setPreserveHost(true)
            ->setRetries(10)
            ->setUpstreamConnectTimeout(10000)
            ->setUpstreamSendTimeout(10000)
            ->setUpstreamReadTimeout(10000)
            ->setHttpsOnly(true)
            ->setHttpIfTerminated(false)
            ->setCreatedAt(42)
            ->setSize(50)
            ->setOffset('offset');

        $this->assertSame(
            'name=name&hosts=hosts&uris=uris&methods=methods&upstream_url=upstreamUrl&strip_uri=0&preserve_host=1&retries=10&upstream_connect_timeout=10000&upstream_send_timeout=10000&upstream_read_timeout=10000&https_only=1&http_if_terminated=0&created_at=42&size=50&offset=offset',
            $this->document->toQueryString()
        );
    }
}
