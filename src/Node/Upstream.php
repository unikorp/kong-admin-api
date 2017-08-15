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
use Unikorp\KongAdminApi\Document\UpstreamDocument as Document;

/**
 * upstream
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Upstream extends AbstractNode
{
    /**
     * add upstream
     *
     * @param \Unikorp\KongAdminApi\Document\UpstreamDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addUpstream(Document $document): ResponseInterface
    {
        return $this->post('/upstreams/', $document);
    }

    /**
     * retrieve upstream
     *
     * @param string $nameOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveUpstream(string $nameOrId): ResponseInterface
    {
        return $this->get(sprintf('/upstreams/%1$s', $nameOrId));
    }

    /**
     * list upstreams
     *
     * @param \Unikorp\KongAdminApi\Document\UpstreamDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listUpstreams(Document $document = null): ResponseInterface
    {
        return $this->get('/upstreams/', $document);
    }

    /**
     * update upstream
     *
     * @param string $nameOrId
     * @param \Unikorp\KongAdminApi\Document\UpstreamDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateUpstream(string $nameOrId, Document $document): ResponseInterface
    {
        return $this->patch(sprintf('/upstreams/%1$s', $nameOrId), $document);
    }

    /**
     * update or create upstream
     *
     * @param \Unikorp\KongAdminApi\Document\UpstreamDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateOrCreateUpstream(Document $document): ResponseInterface
    {
        return $this->put('/upstreams/', $document);
    }

    /**
     * delete upstream
     *
     * @param string $nameOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteUpstream(string $nameOrId): ResponseInterface
    {
        return $this->delete(sprintf('/upstreams/%1$s', $nameOrId));
    }
}
