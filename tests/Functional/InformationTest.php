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
use Unikorp\KongAdminApi\Node\Information as Node;

/**
 * information test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class InformationTest extends TestCase
{
    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\Information $node
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
        $this->node = $client->getNode('information');
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
     * test add retrieve node information
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Information::retrieveNodeInformation
     */
    public function testRetreiveNodeInformation()
    {
        // assert
        $response = $this->node->retrieveNodeInformation();
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'tagline' => 'Welcome to kong',
        ], $data);
    }

    /**
     * test add retrieve node status
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\Information::retrieveNodeStatus
     */
    public function testRetreiveNodeStatus()
    {
        // assert
        $response = $this->node->retrieveNodeStatus();
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArrayHasKey('server', $data);
        $this->assertArrayHasKey('database', $data);
    }
}
