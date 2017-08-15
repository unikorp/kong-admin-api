<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Tests\Functional;

use PHPUnit\Framework\TestCase;
use Unikorp\KongAdminApi\Client;
use Unikorp\KongAdminApi\Configurator;
use Unikorp\KongAdminApi\Document\UpstreamDocument as Document;
use Unikorp\KongAdminApi\Node\Upstream as Node;

/**
 * upstream test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class UpstreamTest extends TestCase
{
    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\Upstream $node
     */
    private $node = null;

    /**
     * set up
     *
     * @return void
     *
     * @coversNothing
     */
    protected function setUp()
    {
        // create configurator
        $configurator = new Configurator();
        $configurator->setBaseUri('http://127.0.0.1/');
        $configurator->setHeaders([
            'Host' => 'test.kong.localhost',
        ]);

        // create client
        $client = new Client($configurator);

        // get node
        $this->node = $client->getNode('upstream');

        // fixture: add upstreams
        $document = new Document();
        $document
            ->setName('TestUpstream');
        $this->node->addUpstream($document);

        $document = new Document();
        $document
            ->setName('OtherUpstream');
        $this->node->addUpstream($document);
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
        // remove upstreams
        $upstreams = json_decode($this->node->listUpstreams()->getBody()->getContents(), true)['data'];
        array_walk($upstreams, function ($upstream) {
            $this->node->deleteUpstream($upstream['name']);
        });

        // reset node
        $this->node = null;
    }

    /**
     * test add upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Upstream::addUpstream
     */
    public function testAddUpstream()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('testAddUpstream');

        // assert
        $response = $this->node->addUpstream($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'testAddUpstream',
        ], $data);
    }

    /**
     * test retrieve upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Upstream::retrieveUpstream
     */
    public function testRetrieveUpstream()
    {
        // assert
        $response = $this->node->retrieveUpstream('TestUpstream');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'TestUpstream',
        ], $data);
    }

    /**
     * test list upstreams
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Upstream::listUpstreams
     */
    public function testListUpstreams()
    {
        // get upstream id
        $upstreamId = json_decode($this->node->listUpstreams()->getBody()->getContents(), true)['data'][0]['id'];

        // prepare document
        $document = new Document();
        $document
            ->setSize(1)
            ->setOffset($upstreamId);

        // assert
        $response = $this->node->listUpstreams($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 2,
            'data' => [
                [
                    'id' => $upstreamId,
                ],
            ],
        ], $data);
    }

    /**
     * test update upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Upstream::updateUpstream
     */
    public function testUpdateUpstream()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('testUpdateUpstream');

        // assert
        $response = $this->node->updateUpstream('TestUpstream', $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'testUpdateUpstream',
        ], $data);
    }

    /**
     * test update or create upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Upstream::updateOrCreateUpstream
     */
    public function testUpdateOrCreateUpstream()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('testUpdateOrCreateUpstream');

        // assert
        $response = $this->node->updateOrCreateUpstream($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'testUpdateOrCreateUpstream',
        ], $data);
    }

    /**
     * test delete upstream
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Upstream::deleteUpstream
     */
    public function testDeleteUpstream()
    {
        // assert
        $response = $this->node->deleteUpstream('TestUpstream');

        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame('No Content', $response->getReasonPhrase());
    }
}
