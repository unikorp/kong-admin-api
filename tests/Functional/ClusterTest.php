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
use Unikorp\KongAdminApi\Document\Cluster as Document;
use Unikorp\KongAdminApi\Node\Cluster as Node;

/**
 * cluster test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ClusterTest extends TestCase
{
    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\Cluster $node
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
        $this->node = $client->getNode('cluster');
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
        $this->node = null;
    }

    /**
     * test retrieve cluster status
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Cluster::retrieveClusterStatus
     */
    public function testRetrieveClusterStatus()
    {
        // assert
        $response = $this->node->retrieveClusterStatus();
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => '2',
        ], $data);
    }

    /**
     * test add a node
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Cluster::addANode
     */
    public function testAddANode()
    {
        // get node address
        $nodeAddress = json_decode($this->node->retrieveClusterStatus()->getBody()->getContents(), true)['data'][0]['address'];

        // prepare document
        $document = new Document();
        $document
            ->setAddress($nodeAddress);

        // assert
        $response = $this->node->addANode($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertSame(null, $data);
    }

    /**
     * test forcibly remove a node
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Cluster::forciblyRemoveANode
     */
    public function testForciblyRemoveANode()
    {
        // get node name
        $nodeName = json_decode($this->node->retrieveClusterStatus()->getBody()->getContents(), true)['data'][0]['name'];

        // prepare document
        $document = new Document();
        $document
            ->setName($nodeName);

        // assert
        $response = $this->node->forciblyRemoveANode($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertSame(null, $data);
    }
}
