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
use Unikorp\KongAdminApi\Document\Api as Document;

/**
 * api
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Api extends AbstractNode
{
    /**
     * add api
     *
     * @param \Unikorp\KongAdminApi\Document\Api $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addApi(Document $document): ResponseInterface
    {
        return $this->post('/apis/', $document);
    }

    /**
     * retrieve api
     *
     * @param string $nameOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveApi(string $nameOrId): ResponseInterface
    {
        return $this->get(sprintf('/apis/%1$s', $nameOrId));
    }

    /**
     * list apis
     *
     * @param \Unikorp\KongAdminApi\Document\Api $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listApis(Document $document = null): ResponseInterface
    {
        return $this->get('/apis/', $document);
    }

    /**
     * update api
     *
     * @param string $nameOrId
     * @param \Unikorp\KongAdminApi\Document\Api $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateApi(string $nameOrId, Document $document): ResponseInterface
    {
        return $this->patch(sprintf('/apis/%1$s', $nameOrId), $document);
    }

    /**
     * update or create api
     *
     * @param \Unikorp\KongAdminApi\Document\Api $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateOrCreateApi(Document $document): ResponseInterface
    {
        return $this->put('/apis/', $document);
    }

    /**
     * delete api
     *
     * @param string $nameOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteApi(string $nameOrId): ResponseInterface
    {
        return $this->delete(sprintf('/apis/%1$s', $nameOrId));
    }
}
