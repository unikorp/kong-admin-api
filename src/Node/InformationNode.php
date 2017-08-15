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

/**
 * information node
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class InformationNode extends AbstractNode
{
    /**
     * retrieve node information
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveNodeInformation(): ResponseInterface
    {
        return $this->get('/');
    }

    /**
     * retrieve node status
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveNodeStatus(): ResponseInterface
    {
        return $this->get('/status');
    }
}
