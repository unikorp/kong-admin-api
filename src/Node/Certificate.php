<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Node;

use Psr\Http\Message\ResponseInterface;
use Unikorp\KongAdminApi\AbstractNode;
use Unikorp\KongAdminApi\Document\CertificateDocument as Document;

/**
 * certificate
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Certificate extends AbstractNode
{
    /**
     * add certificate
     *
     * @param \Unikorp\KongAdminApi\Document\CertificateDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addCertificate(Document $document): ResponseInterface
    {
        return $this->post('/certificates/', $document);
    }

    /**
     * retrieve certificate
     *
     * @param string $sniOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveCertificate(string $sniOrId): ResponseInterface
    {
        return $this->get(sprintf('/certificates/%1$s', $sniOrId));
    }

    /**
     * list certificates
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listCertificates(): ResponseInterface
    {
        return $this->get('/certificates/');
    }

    /**
     * update certificate
     *
     * @param string $sniOrId
     * @param \Unikorp\KongAdminApi\Document\CertificateDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateCertificate(string $sniOrId, Document $document): ResponseInterface
    {
        return $this->patch(sprintf('/certificates/%1$s', $sniOrId), $document);
    }

    /**
     * update or create certificate
     *
     * @param \Unikorp\KongAdminApi\Document\CertificateDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateOrCreateCertificate(Document $document): ResponseInterface
    {
        return $this->put('/certificates/', $document);
    }

    /**
     * delete certificate
     *
     * @param string $sniOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteCertificate(string $sniOrId): ResponseInterface
    {
        return $this->delete(sprintf('/certificates/%1$s', $sniOrId));
    }
}
