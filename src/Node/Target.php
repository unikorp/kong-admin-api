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
use Unikorp\KongAdminApi\Document\Target as Document;

/**
 * target
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Target extends AbstractNode
{
    /**
     * add target
     *
     * @param string $nameOrId
     * @param \Unikorp\KongAdminApi\Document\Target $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addTarget(string $nameOrId, Document $document): ResponseInterface
    {
        return $this->post(sprintf('/upstreams/%1$s/targets', $nameOrId), $document);
    }

    /**
     * list targets
     *
     * @param string $nameOrId
     * @param \Unikorp\KongAdminApi\Document\Target $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listTargets(string $nameOrId, Document $document = null): ResponseInterface
    {
        return $this->get(sprintf('/upstreams/%1$s/targets', $nameOrId), $document);
    }

    /**
     * list active targets
     *
     * @param string $nameOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listActiveTargets(string $nameOrId): ResponseInterface
    {
        return $this->get(sprintf('/upstreams/%1$s/targets/active', $nameOrId));
    }

    /**
     * delete target
     *
     * @param string $nameOrId
     * @param string $target
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteTarget(string $nameOrId, string $target): ResponseInterface
    {
        return $this->delete(sprintf('/upstreams/%1$s/targets/%2$s', $nameOrId, $target));
    }
}
