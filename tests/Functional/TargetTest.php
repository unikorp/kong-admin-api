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
use Unikorp\KongAdminApi\Document\Target as Document;
use Unikorp\KongAdminApi\Document\Upstream;
use Unikorp\KongAdminApi\Node\Target as Node;

/**
 * target test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class TargetTest extends TestCase
{
    /**
     * client
     * @param \Unikorp\KongAdminApi\Client $client
     */
    private $client = null;

    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\Target $node
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
        $this->client = new Client($configurator);

        // get node
        $this->node = $this->client->getNode('target');

        // fixture: add upstream
        $document = new Upstream();
        $document
            ->setName('TestUpstream');
        $this->client->getNode('upstream')->addUpstream($document);

        // fixture: add target
        $document = new Document();
        $document
            ->setTarget('1.2.3.4:80');
        $this->node->addTarget('TestUpstream', $document);
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
        // remove targets
        $targets = json_decode($this->node->listTargets('TestUpstream')->getBody()->getContents(), true)['data'];
        array_walk($targets, function ($target) {
            $response = $this->node->deleteTarget('TestUpstream', $target['id']);
        });

        // remove upstreams
        $upstreams = json_decode($this->client->getNode('upstream')->listUpstreams()->getBody()->getContents(), true)['data'];
        array_walk($upstreams, function ($upstream) {
            $this->client->getNode('upstream')->deleteUpstream($upstream['name']);
        });

        // reset node & client
        $this->node = null;
        $this->client = null;
    }

    /**
     * test add target
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Target::addTarget
     */
    public function testAddTarget()
    {
        // prepare document
        $document = new Document();
        $document
            ->setTarget('1.2.3.4:81');

        // assert
        $response = $this->node->addTarget('TestUpstream', $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'target' => '1.2.3.4:81',
        ], $data);
    }

    /**
     * test list targets
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Target::listTargets
     */
    public function testListTargets()
    {
        // assert
        $response = $this->node->listTargets('TestUpstream');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 1,
            'data' => [
                [
                    'target' => '1.2.3.4:80',

                ],
            ],
        ], $data);
    }

    /**
     * test list active targets
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Target::listActiveTargets
     */
    public function testListActiveTargets()
    {
        // assert
        $response = $this->node->listActiveTargets('TestUpstream');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 1,
            'data' => [
                [
                    'target' => '1.2.3.4:80',

                ],
            ],
        ], $data);
    }

    /**
     * test delete targets
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Target::deleteTarget
     */
    public function testDeleteTarget()
    {
        // get target id
        $targetId = json_decode($this->node->listTargets('TestUpstream')->getBody()->getContents(), true)['data'][0]['id'];

        // assert
        $response = $this->node->deleteTarget('TestUpstream', $targetId);

        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame('No Content', $response->getReasonPhrase());
    }
}
