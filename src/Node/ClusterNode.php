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
use Unikorp\KongAdminApi\Document\ClusterDocument as Document;

/**
 * cluster node
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ClusterNode extends AbstractNode
{
    /**
     * retrieve cluster status
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveClusterStatus(): ResponseInterface
    {
        return $this->get('/cluster');
    }

    /**
     * add a node
     *
     * @param \Unikorp\KongAdminApi\Document\ClusterDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addANode(Document $document): ResponseInterface
    {
        return $this->post('/cluster', $document);
    }

    /**
     * forcibly remove a node
     *
     * @param \Unikorp\KongAdminApi\Document\ClusterDocument $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function forciblyRemoveANode(Document $document): ResponseInterface
    {
        return $this->delete('/cluster', $document);
    }
}
