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
 * consumer document
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class ConsumerDocument extends AbstractDocument
{
    /**
     * username
     * @var string $username
     */
    protected $username = null;

    /**
     * custom id
     * @var string $customId
     */
    protected $customId = null;

    /**
     * set username
     *
     * @param string $username
     *
     * @return this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * get username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * set custom id
     *
     * @param string $customId
     *
     * @return this
     */
    public function setCustomId(string $customId): self
    {
        $this->customId = $customId;

        return $this;
    }

    /**
     * get custom id
     *
     * @return string
     */
    public function getCustomId(): string
    {
        return $this->customId;
    }

    /**
     * get fields
     *
     * @return array
     */
    protected function getFields(): array
    {
        return [
            'username',
            'customId',
        ];
    }
}
