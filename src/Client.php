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

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Unikorp\KongAdminApi\NodeInterface;

/**
 * client
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Client
{
    /**
     * configurator
     * @var \Unikorp\KongAdminApi\ConfiguratorInterface $configurator
     */
    private $configurator = null;

    /**
     * http client
     * @var \Http\Client\HttpClient $httpClient
     */
    private $httpClient = null;

    /**
     * message factory
     * @var \Http\Message\MessageFactory $messageFactory
     */
    private $messageFactory = null;

    /**
     * plugins
     * @var array $plugins
     */
    private $plugins = [];

    /**
     * constructor
     *
     * @param \Unikorm\KongAdminApi\ConfiguratorInterface $configurator
     * @param \Http\Client\HttpClient $httpClient
     */
    public function __construct(ConfiguratorInterface $configurator, HttpClient $httpClient = null)
    {
        $this->configurator = $configurator;

        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->messageFactory = MessageFactoryDiscovery::find();

        $this->plugins[] = new Plugin\AddHostPlugin(
            UriFactoryDiscovery::find()->createUri($configurator->getBaseUri())
        );

        $this->plugins[] = new Plugin\HeaderSetPlugin($configurator->getHeaders());
    }

    /**
     * get node
     *
     * @param string $name
     *
     * @return \Unikorp\KongAdminApi\NodeInterface
     */
    public function getNode(string $name): NodeInterface
    {
        $node = $this->configurator->getNode($name);

        return new $node($this);
    }

    /**
     * add plugin
     *
     * @param \Http\Client\Common\Plugin $plugin
     *
     * @return void
     */
    public function addPlugin(Plugin $plugin): void
    {
        $this->plugins[] = $plugin;
    }

    /**
     * get http client
     *
     * @return \Http\Client\Common\HttpMethodsClient
     */
    public function getHttpClient(): HttpMethodsClient
    {
        return new HttpMethodsClient(
            new PluginClient($this->httpClient, $this->plugins),
            $this->messageFactory
        );
    }
}
