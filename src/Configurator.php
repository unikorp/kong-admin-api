<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi;

use Unikorp\KongAdminApi\Node;

/**
 * configurator
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Configurator implements ConfiguratorInterface
{
    /**
     * base uri
     * @var string $baseUri
     */
    private $baseUri = null;

    /**
     * nodes
     * @var array $nodes
     */
    private $nodes = [];

    /**
     * construct
     */
    public function __construct()
    {
        $this->nodes = [
            'api' => Node\Api::class,
            'cluster' => Node\Cluster::class,
            'consumer' => Node\Consumer::class,
            'information' => Node\Information::class,
            'plugin' => Node\Plugin::class,
        ];
    }

    /**
     * set base uri
     *
     * @param string $baseUri
     *
     * @return void
     */
    public function setBaseUri(string $baseUri): void
    {
        $this->baseUri = $baseUri;
    }

    /**
     * get base uri
     *
     * @return string $baseUri
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * add node
     *
     * @param string $name
     * @param string $class
     *
     * @return void
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function addNode(string $name, string $class): void
    {
        if (!empty($this->nodes[$name])) {
            throw new \RuntimeException(sprintf('Node for key `%1$s` already exists', $name));
        }

        if (!class_exists($class)) {
            throw new \RuntimeException(sprintf('Node class `%1$s` does not exists', $class));
        }

        $this->nodes[$name] = $class;
    }

    /**
     * remove node
     *
     * @param string $name
     *
     * @return void
     */
    public function removeNode(string $name): void
    {
        if (isset($this->nodes[$name])) {
            unset($this->nodes[$name]);
        }
    }

    /**
     * get node
     *
     * @param string $name
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function getNode(string $name): string
    {
        if (empty($this->nodes[$name])) {
            throw new \RuntimeException(sprintf('Node for key `%1$s` does not exists', $name));
        }

        return $this->nodes[$name];
    }
}
