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
 * api
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Api extends AbstractDocument
{
    /**
     * name
     * @var string $name
     */
    protected $name = null;

    /**
     * request host
     * @var string $requestHost
     */
    protected $requestHost = null;

    /**
     * request path
     * @var string $requestPath
     */
    protected $requestPath = null;

    /**
     * strip request path
     * @var bool $stripRequestPath
     */
    protected $stripRequestPath = false;

    /**
     * preserve host
     * @var bool $preserveHost
     */
    protected $preserveHost = false;

    /**
     * upstream url
     * @var string $upstreamUrl
     */
    protected $upstreamUrl = null;

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
     * set request host
     *
     * @param string $requestHost
     *
     * @return this
     */
    public function setRequestHost(string $requestHost): self
    {
        $this->requestHost = $requestHost;

        return $this;
    }

    /**
     * get request host
     *
     * @return string
     */
    public function getRequestHost(): string
    {
        return $this->requestHost;
    }

    /**
     * set request path
     *
     * @param string $requestPath
     *
     * @return this
     */
    public function setRequestPath(string $requestPath): self
    {
        $this->requestPath = $requestPath;

        return $this;
    }

    /**
     * get request path
     *
     * @return string
     */
    public function getRequestPath(): string
    {
        return $this->requestPath;
    }

    /**
     * set strip request path
     *
     * @param bool $stripRequestPath
     *
     * @return this
     */
    public function setStripRequestPath(bool $stripRequestPath): self
    {
        $this->stripRequestPath = $stripRequestPath;

        return $this;
    }

    /**
     * get strip request path
     *
     * @return bool
     */
    public function getStripRequestPath(): bool
    {
        return $this->stripRequestPath;
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
     * get fields
     *
     * @return array
     */
    protected function getFields(): array
    {
        return [
            'name',
            'requestHost',
            'requestPath',
            'stripRequestPath',
            'preserveHost',
            'upstreamUrl',
        ];
    }
}
