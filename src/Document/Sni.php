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
 * sni
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Sni extends AbstractDocument
{
    /**
     * name
     * @var string $name
     */
    protected $name = null;

    /**
     * ssl certificate id
     * @var string $sslCertificateId
     */
    protected $sslCertificateId = null;

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
     * set ssl certificate id
     *
     * @param string $sslCertificateId
     *
     * @return this
     */
    public function setSslCertificateId(string $sslCertificateId): self
    {
        $this->sslCertificateId = $sslCertificateId;

        return $this;
    }

    /**
     * get ssl certificate id
     *
     * @return string
     */
    public function getSslCertificateId(): string
    {
        return $this->sslCertificateId;
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
            'sslCertificateId',
        ];
    }
}
