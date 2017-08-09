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
use Unikorp\KongAdminApi\Document\Consumer as Document;

/**
 * consumer
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Consumer extends AbstractNode
{
    /**
     * create consumer
     *
     * @param \Unikorp\KongAdminApi\Document\Consumer $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function createConsumer(Document $document): ResponseInterface
    {
        return $this->post('/consumers/', $document);
    }

    /**
     * retrieve consumer
     *
     * @param string $usernameOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveConsumer(string $usernameOrId): ResponseInterface
    {
        return $this->get(sprintf('/consumers/%1$s', $usernameOrId));
    }

    /**
     * list consumers
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listConsumers(): ResponseInterface
    {
        return $this->get('/consumers/');
    }

    /**
     * update consumer
     *
     * @param string $usernameOrId
     * @param \Unikorp\KongAdminApi\Document\Consumer $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateConsumer(string $usernameOrId, Document $document): ResponseInterface
    {
        return $this->patch(sprintf('/consumers/%1$s', $usernameOrId), $document);
    }

    /**
     * update or create consumer
     *
     * @param \Unikorp\KongAdminApi\Document\Consumer $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateOrCreateConsumer(Document $document): ResponseInterface
    {
        return $this->put('/consumers/', $document);
    }

    /**
     * delete consumer
     *
     * @param string $usernameOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteConsumer(string $usernameOrId): ResponseInterface
    {
        return $this->delete(sprintf('/consumers/%1$s', $usernameOrId));
    }
}
