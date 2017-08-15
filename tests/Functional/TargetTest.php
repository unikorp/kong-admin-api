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
use Unikorp\KongAdminApi\Document\TargetDocument as Document;
use Unikorp\KongAdminApi\Document\UpstreamDocument;
use Unikorp\KongAdminApi\Node\TargetNode as Node;

/**
 * target test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class TargetNodeTest extends TestCase
{
    /**
     * client
     * @param \Unikorp\KongAdminApi\Client $client
     */
    private $client = null;

    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\TargetNode $node
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
        $document = new UpstreamDocument();
        $document
            ->setName('TestUpstream');
        $this->client->getNode('upstream')->addUpstream($document);

        // fixture: add targets
        $document = new Document();
        $document
            ->setTarget('1.2.3.4:80');
        $this->node->addTarget('TestUpstream', $document);

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
     * @covers \Unikorp\KongAdminApi\Node\TargetNode::addTarget
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
     * @covers \Unikorp\KongAdminApi\Node\TargetNode::listTargets
     */
    public function testListTargets()
    {
        // get target id
        $targetId = json_decode($this->node->listTargets('TestUpstream')->getBody()->getContents(), true)['data'][0]['id'];

        // prepare document
        $document = new Document();
        $document
            ->setSize(1)
            ->setOffset($targetId);

        // assert
        $response = $this->node->listTargets('TestUpstream', $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 2,
            'data' => [
                [
                    'id' => $targetId,

                ],
            ],
        ], $data);
        $this->assertCount(1, $data['data']);
    }

    /**
     * test list active targets
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\TargetNode::listActiveTargets
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
     * @covers \Unikorp\KongAdminApi\Node\TargetNode::deleteTarget
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
