<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Document;

use Unikorp\KongAdminApi\AbstractDocument;

/**
 * api document
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ApiDocument extends AbstractDocument
{
    /**
     * name
     * @var string $name
     */
    protected $name = null;

    /**
     * hosts
     * @var string $hosts
     */
    protected $hosts = null;

    /**
     * uris
     * @var string $uris
     */
    protected $uris = null;

    /**
     * methods
     * @var string $methods
     */
    protected $methods = null;

    /**
     * upstream url
     * @var string $upstreamUrl
     */
    protected $upstreamUrl = null;

    /**
     * strip uri
     * @var bool $stripUri
     */
    protected $stripUri = true;

    /**
     * preserve host
     * @var bool $preserveHost
     */
    protected $preserveHost = false;

    /**
     * retries
     * @var int $retries
     */
    protected $retries = 5;

    /**
     * upstream connect timeout
     * @var int $upstreamConnectTimeout
     */
    protected $upstreamConnectTimeout = 60000;

    /**
     * upstream send timeout
     * @var int $upstreamSendTimeout
     */
    protected $upstreamSendTimeout = 60000;

    /**
     * upstream read timeout
     * @var int $upstreamReadTimeout
     */
    protected $upstreamReadTimeout = 60000;

    /**
     * https only
     * @var bool $httpsOnly
     */
    protected $httpsOnly = false;

    /**
     * http if terminated
     * @var bool $httpIfTerminated
     */
    protected $httpIfTerminated = true;

    /**
     * set name
     *
     * @param string $name
     *
     * @return this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * set hosts
     *
     * @param string $hosts
     *
     * @return this
     */
    public function setHosts(string $hosts): self
    {
        $this->hosts = $hosts;

        return $this;
    }

    /**
     * get hosts
     *
     * @return string
     */
    public function getHosts(): string
    {
        return $this->hosts;
    }

    /**
     * set uris
     *
     * @param string $uris
     *
     * @return this
     */
    public function setUris(string $uris): self
    {
        $this->uris = $uris;

        return $this;
    }

    /**
     * get uris
     *
     * @return string
     */
    public function getUris(): string
    {
        return $this->uris;
    }

    /**
     * set methods
     *
     * @param string $methods
     *
     * @return this
     */
    public function setMethods(string $methods): self
    {
        $this->methods = $methods;

        return $this;
    }

    /**
     * get methods
     *
     * @return string
     */
    public function getMethods(): string
    {
        return $this->methods;
    }

    /**
     * set upstream url
     *
     * @param string $upstreamUrl
     *
     * @return this
     */
    public function setUpstreamUrl(string $upstreamUrl): self
    {
        $this->upstreamUrl = $upstreamUrl;

        return $this;
    }

    /**
     * get upstream url
     *
     * @return string
     */
    public function getUpstreamUrl(): string
    {
        return $this->upstreamUrl;
    }

    /**
     * set strip uri
     *
     * @param bool $stripUri
     *
     * @return this
     */
    public function setStripUri(bool $stripUri): self
    {
        $this->stripUri = $stripUri;

        return $this;
    }

    /**
     * get strip uri
     *
     * @return bool
     */
    public function getStripUri(): bool
    {
        return $this->stripUri;
    }

    /**
     * set preserve host
     *
     * @param bool $preserveHost
     *
     * @return this
     */
    public function setPreserveHost(bool $preserveHost): self
    {
        $this->preserveHost = $preserveHost;

        return $this;
    }

    /**
     * get preserve host
     *
     * @return bool
     */
    public function getPreserveHost(): bool
    {
        return $this->preserveHost;
    }

    /**
     * set retries
     *
     * @param int $retries
     *
     * @return this
     */
    public function setRetries(int $retries): self
    {
        $this->retries = $retries;

        return $this;
    }

    /**
     * get retries
     *
     * @return int
     */
    public function getRetries(): int
    {
        return $this->retries;
    }

    /**
     * set upstream connect timeout
     *
     * @param int $upstreamConnectTimeout
     *
     * @return this
     */
    public function setUpstreamConnectTimeout(int $upstreamConnectTimeout): self
    {
        $this->upstreamConnectTimeout = $upstreamConnectTimeout;

        return $this;
    }

    /**
     * get upstream connect timeout
     *
     * @return int
     */
    public function getUpstreamConnectTimeout(): int
    {
        return $this->upstreamConnectTimeout;
    }

    /**
     * set upstream send timeout
     *
     * @param int $upstreamSendTimeout
     *
     * @return this
     */
    public function setUpstreamSendTimeout(int $upstreamSendTimeout): self
    {
        $this->upstreamSendTimeout = $upstreamSendTimeout;

        return $this;
    }

    /**
     * get upstream send timeout
     *
     * @return int
     */
    public function getUpstreamSendTimeout(): int
    {
        return $this->upstreamSendTimeout;
    }

    /**
     * set upstream read timeout
     *
     * @param int $upstreamReadTimeout
     *
     * @return this
     */
    public function setUpstreamReadTimeout(int $upstreamReadTimeout): self
    {
        $this->upstreamReadTimeout = $upstreamReadTimeout;

        return $this;
    }

    /**
     * get upstream read timeout
     *
     * @return int
     */
    public function getUpstreamReadTimeout(): int
    {
        return $this->upstreamReadTimeout;
    }

    /**
     * set https only
     *
     * @param bool $httpsOnly
     *
     * @return this
     */
    public function setHttpsOnly(bool $httpsOnly): self
    {
        $this->httpsOnly = $httpsOnly;

        return $this;
    }

    /**
     * get https only
     *
     * @return bool
     */
    public function getHttpsOnly(): bool
    {
        return $this->httpsOnly;
    }

    /**
     * set http if terminated
     *
     * @param bool $httpIfTerminated
     *
     * @return this
     */
    public function setHttpIfTerminated(bool $httpIfTerminated): self
    {
        $this->httpIfTerminated = $httpIfTerminated;

        return $this;
    }

    /**
     * get http if terminated
     *
     * @return bool
     */
    public function getHttpIfTerminated(): bool
    {
        return $this->httpIfTerminated;
    }

    /**
     * get fields
     *
     * @return array
     */
    protected function getFields(): array
    {
        return [
            'name',
            'hosts',
            'uris',
            'methods',
            'upstreamUrl',
            'stripUri',
            'preserveHost',
            'retries',
            'upstreamConnectTimeout',
            'upstreamSendTimeout',
            'upstreamReadTimeout',
            'httpsOnly',
            'httpIfTerminated',
        ];
    }
}
