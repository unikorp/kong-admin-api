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
 * certificate document
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class CertificateDocument extends AbstractDocument
{
    /**
     * cert
     * @var string $cert
     */
    protected $cert = null;

    /**
     * key
     * @var string $key
     */
    protected $key = null;

    /**
     * snis
     * @var string $snis
     */
    protected $snis = null;

    /**
     * set cert
     *
     * @param string $cert
     *
     * @return this
     */
    public function setCert(string $cert): self
    {
        $this->cert = $cert;

        return $this;
    }

    /**
     * get cert
     *
     * @return string
     */
    public function getCert(): string
    {
        return $this->cert;
    }

    /**
     * set key
     *
     * @param string $key
     *
     * @return this
     */
    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * get key
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * set snis
     *
     * @param string $snis
     *
     * @return this
     */
    public function setSnis(string $snis): self
    {
        $this->snis = $snis;

        return $this;
    }

    /**
     * get snis
     *
     * @return string
     */
    public function getSnis(): string
    {
        return $this->snis;
    }

    /**
     * get fields
     *
     * @return array
     */
    protected function getFields(): array
    {
        return [
            'cert',
            'key',
            'snis',
        ];
    }
}
