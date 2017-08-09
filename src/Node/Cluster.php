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
use Unikorp\KongAdminApi\Document\Cluster as Document;

/**
 * cluster
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Cluster extends AbstractNode
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
     * forcibly remove a node
     *
     * @param \Unikorp\KongAdminApi\Document\Cluster $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function forciblyRemoveANode(Document $document): ResponseInterface
    {
        return $this->delete('/cluster', $document);
    }
}
