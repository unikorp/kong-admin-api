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
     * cluster information
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function clusterInformation(): ResponseInterface
    {
        return $this->get('/cluster');
    }

    /**
     * retrieve cluster status
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveClusterStatus(): ResponseInterface
    {
        return $this->get('/cluster/nodes/');
    }

    /**
     * forcibly remove a node
     *
     * @param string $name
     * @param \Unikorp\KongAdminApi\Document\Cluster $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function forciblyRemoveANode(string $name, Document $document): ResponseInterface
    {
        return $this->delete(sprintf('/cluster/nodes/%1$s', $name), $document);
    }
}
