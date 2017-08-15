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
use Unikorp\KongAdminApi\Document\CertificateDocument;
use Unikorp\KongAdminApi\Document\SniDocument as Document;
use Unikorp\KongAdminApi\Node\SniNode as Node;

/**
 * sni test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class SniNodeTest extends TestCase
{
    /**
     * client
     * @param \Unikorp\KongAdminApi\Client $client
     */
    private $client = null;

    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\SniNode $node
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
        $this->node = $this->client->getNode('sni');

        // fixture: add sni
        $document = new Document();
        $document
            ->setName('TestSni');
        $this->node->addSni($document);

        // fixture: add certificate
        $document = new CertificateDocument();
        $document
            ->setCert('-----BEGIN CERTIFICATE----- TestCertificate ...')
            ->setKey('-----BEGIN RSA PRIVATE KEY----- TestCertificate ...');
        $this->client->getNode('certificate')->addCertificate($document);
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
        // remove certificates
        $certificates = json_decode($this->client->getNode('certificate')->listCertificates()->getBody()->getContents(), true)['data'];
        array_walk($certificates, function ($certificate) {
            $this->client->getNode('certificate')->deleteCertificate($certificate['id']);
        });

        // remove snis
        $snis = json_decode($this->node->listSnis()->getBody()->getContents(), true)['data'];
        array_walk($snis, function ($sni) {
            $this->node->deleteSni($sni['name']);
        });

        // reset node & client
        $this->node = null;
        $this->client = null;
    }

    /**
     * test add sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::addSni
     */
    public function testAddSni()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('testAddSni');

        // assert
        $response = $this->node->addSni($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'testAddSni',
        ], $data);
    }

    /**
     * test retrieve sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::retrieveSni
     */
    public function testRetrieveSni()
    {
        // assert
        $response = $this->node->retrieveSni('TestSni');
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'TestSni',
        ], $data);
    }

    /**
     * test list snis
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::listSnis
     */
    public function testListSnis()
    {
        // assert
        $response = $this->node->listSnis();
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 1,
            'data' => [
                [
                    'name' => 'TestSni',
                ],
            ],
        ], $data);
    }

    /**
     * test update sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::updateSni
     */
    public function testUpdateSni()
    {
        // get certificate id
        $certificateId = json_decode($this->client->getNode('certificate')->listCertificates()->getBody()->getContents(), true)['data'][0]['id'];

        // prepare document
        $document = new Document();
        $document
            ->setSslCertificateId($certificateId);

        // assert
        $response = $this->node->updateSni('TestSni', $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'name' => 'TestSni',
            'ssl_certificate_id' => $certificateId,
        ], $data);
    }

    /**
     * test update or create sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::updateOrCreateSni
     */
    public function testUpdateOrCreateSni()
    {
        // prepare document
        $document = new Document();
        $document
            ->setName('testUpdateOrCreateSni');

        // assert
        $response = $this->node->updateOrCreateSni($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertSame(null, $data);
    }

    /**
     * test delete sni
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\SniNode::deleteSni
     */
    public function testDeleteSni()
    {
        // assert
        $response = $this->node->deleteSni('TestSni');

        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame('No Content', $response->getReasonPhrase());
    }
}
