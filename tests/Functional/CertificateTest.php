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
use Unikorp\KongAdminApi\Document\CertificateDocument as Document;
use Unikorp\KongAdminApi\Node\CertificateNode as Node;

/**
 * certificate test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class CertificateNodeTest extends TestCase
{
    /**
     * node
     * @param \Unikorp\KongAdminApi\Node\CertificateNode $node
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
        $this->node = $client->getNode('certificate');

        // fixture: add certificate
        $document = new Document();
        $document
            ->setCert('-----BEGIN CERTIFICATE----- TestCertificate ...')
            ->setKey('-----BEGIN RSA PRIVATE KEY----- TestCertificate ...');
        $this->node->addCertificate($document);
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
        $certificates = json_decode($this->node->listCertificates()->getBody()->getContents(), true)['data'];
        array_walk($certificates, function ($certificate) {
            $this->node->deleteCertificate($certificate['id']);
        });

        // reset node
        $this->node = null;
    }

    /**
     * test add certificate
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\CertificateNode::addCertificate
     */
    public function testAddCertificate()
    {
        // prepare document
        $document = new Document();
        $document
            ->setCert('-----BEGIN CERTIFICATE----- testAddCertificate ...')
            ->setKey('-----BEGIN RSA PRIVATE KEY----- testAddCertificate ...');

        // assert
        $response = $this->node->addCertificate($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'cert' => '-----BEGIN CERTIFICATE----- testAddCertificate ...',
            'key' => '-----BEGIN RSA PRIVATE KEY----- testAddCertificate ...',
        ], $data);
    }

    /**
     * test retrieve certificate
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\CertificateNode::retrieveCertificate
     */
    public function testRetrieveCertificate()
    {
        // get certificate id
        $certificateId = json_decode($this->node->listCertificates()->getBody()->getContents(), true)['data'][0]['id'];

        // assert
        $response = $this->node->retrieveCertificate($certificateId);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'cert' => '-----BEGIN CERTIFICATE----- TestCertificate ...',
            'key' => '-----BEGIN RSA PRIVATE KEY----- TestCertificate ...',
        ], $data);
    }

    /**
     * test list certificates
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\CertificateNode::listCertificates
     */
    public function testListCertificates()
    {
        // assert
        $response = $this->node->listCertificates();
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'total' => 1,
            'data' => [
                [
                    'cert' => '-----BEGIN CERTIFICATE----- TestCertificate ...',
                    'key' => '-----BEGIN RSA PRIVATE KEY----- TestCertificate ...',
                ],
            ],
        ], $data);
    }

    /**
     * test update certificate
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\CertificateNode::updateCertificate
     */
    public function testUpdateCertificate()
    {
        // get certificate id
        $certificateId = json_decode($this->node->listCertificates()->getBody()->getContents(), true)['data'][0]['id'];

        // prepare document
        $document = new Document();
        $document
            ->setCert('-----BEGIN CERTIFICATE----- testUpdateCertificate  ...')
            ->setKey('-----BEGIN RSA PRIVATE KEY----- testUpdateCertificate ...');

        // assert
        $response = $this->node->updateCertificate($certificateId, $document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('OK', $response->getReasonPhrase());
        $this->assertArraySubset([
            'cert' => '-----BEGIN CERTIFICATE----- testUpdateCertificate  ...',
            'key' => '-----BEGIN RSA PRIVATE KEY----- testUpdateCertificate ...',
        ], $data);
    }

    /**
     * test update or create certificate
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\CertificateNode::updateOrCreateCertificate
     */
    public function testUpdateOrCreateCertificate()
    {
        // prepare document
        $document = new Document();
        $document
            ->setCert('-----BEGIN CERTIFICATE----- testUpdateOrCreateCertificate  ...')
            ->setKey('-----BEGIN RSA PRIVATE KEY----- testUpdateOrCreateCertificate ...');

        // assert
        $response = $this->node->updateOrCreateCertificate($document);
        $data = json_decode($response->getBody()->getContents(), true);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertSame('Created', $response->getReasonPhrase());
        $this->assertArraySubset([
            'cert' => '-----BEGIN CERTIFICATE----- testUpdateOrCreateCertificate  ...',
            'key' => '-----BEGIN RSA PRIVATE KEY----- testUpdateOrCreateCertificate ...',
        ], $data);
    }

    /**
     * test delete certificate
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\Node\CertificateNode::deleteCertificate
     */
    public function testDeleteCertificate()
    {
        // get certificate id
        $certificateId = json_decode($this->node->listCertificates()->getBody()->getContents(), true)['data'][0]['id'];

        // assert
        $response = $this->node->deleteCertificate($certificateId);

        $this->assertSame(204, $response->getStatusCode());
        $this->assertSame('No Content', $response->getReasonPhrase());
    }
}
