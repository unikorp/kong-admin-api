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
use Unikorp\KongAdminApi\Document\SniDocument as Document;

/**
 * sni node
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class SniNode extends AbstractNode
{
    /**
     * add sni
     *
     * @param \Unikorp\KongAdminApi\Document\SniDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addSni(Document $document): ResponseInterface
    {
        return $this->post('/snis/', $document);
    }

    /**
     * retrieve sni
     *
     * @param string $name
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveSni(string $name): ResponseInterface
    {
        return $this->get(sprintf('/snis/%1$s', $name));
    }

    /**
     * list snis
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listSnis(): ResponseInterface
    {
        return $this->get('/snis/');
    }

    /**
     * update sni
     *
     * @param string $name
     * @param \Unikorp\KongAdminApi\Document\SniDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateSni(string $name, Document $document): ResponseInterface
    {
        return $this->patch(sprintf('/snis/%1$s', $name), $document);
    }

    /**
     * update or create sni
     *
     * @param \Unikorp\KongAdminApi\Document\SniDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateOrCreateSni(Document $document): ResponseInterface
    {
        return $this->put('/snis/', $document);
    }

    /**
     * delete sni
     *
     * @param string $name
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteSni(string $name): ResponseInterface
    {
        return $this->delete(sprintf('/snis/%1$s', $name));
    }
}
