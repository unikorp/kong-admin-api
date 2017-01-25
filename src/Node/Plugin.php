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
use Unikorp\KongAdminApi\Document\Plugin as Document;

/**
 * plugin
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Plugin extends AbstractNode
{
    /**
     * add plugin
     *
     * @param string $nameOrId
     * @param \Unikorp\KongAdminApi\Document\Plugin $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function addPlugin(string $nameOrId, Document $document): ResponseInterface
    {
        return $this->post(sprintf('/apis/%1$s/plugins/', $nameOrId), $document);
    }

    /**
     * retrieve plugin
     *
     * @param string $id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrievePlugin(string $id): ResponseInterface
    {
        return $this->get(sprintf('/plugins/%1$s', $id));
    }

    /**
     * list all plugins
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listAllPlugins(): ResponseInterface
    {
        return $this->get('/plugins/');
    }

    /**
     * list plugins per api
     *
     * @param string $apiNameOrId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listPluginsPerApi(string $apiNameOrId): ResponseInterface
    {
        return $this->get(sprintf('/apis/%1$s/plugins/', $apiNameOrId));
    }

    /**
     * update plugin
     *
     * @param string $apiNameOrId
     * @param string $id
     * @param \Unikorp\KongAdminApi\Document\Plugin $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updatePlugin(string $apiNameOrId, string $id, Document $document): ResponseInterface
    {
        return $this->patch(sprintf('/apis/%1$s/plugins/%2$s', $apiNameOrId, $id), $document);
    }

    /**
     * update or add plugin
     *
     * @param string $apiNameOrId
     * @param \Unikorp\KongAdminApi\Document\Plugin $document
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateOrAddPlugin(string $apiNameOrId, Document $document): ResponseInterface
    {
        return $this->put(sprintf('/apis/%1$s/plugins/', $apiNameOrId), $document);
    }

    /**
     * delete plugin
     *
     * @param string $apiNameOrId
     * @param string $id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deletePlugin(string $apiNameOrId, string $id): ResponseInterface
    {
        return $this->delete(sprintf('/apis/%1$s/plugins/%2$s', $apiNameOrId, $id));
    }

    /**
     * retrieve enabled plugin
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrieveEnabledPlugin(): ResponseInterface
    {
        return $this->get('/plugins/enabled');
    }

    /**
     * retrieve plugin schema
     *
     * @param string $pluginName
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function retrievePluginSchema(string $pluginName): ResponseInterface
    {
        return $this->get(sprintf('/plugins/schema/%1$s', $pluginName));
    }
}
