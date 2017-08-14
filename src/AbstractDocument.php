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

/**
 * abstract document
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
abstract class AbstractDocument implements DocumentInterface
{
    /**
     * default fields
     * @const array DEFAULT_FIELDS
     */
    const DEFAULT_FIELDS = ['createdAt'];

    /**
     * created at
     * @param int $createdAt
     */
    protected $createdAt = null;

    /**
     * get fields
     *
     * @return array
     */
    abstract protected function getFields(): array;

    /**
     * set created at
     *
     * @param int $createdAt
     *
     * @return this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * get created at
     *
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * to json
     *
     * @return string
     */
    public function toJson(): string
    {
        $document = [];

        foreach (array_merge($this->getFields(), self::DEFAULT_FIELDS) as $field) {
            if (!is_null($value = $this->$field)) {
                $document[$this->toSnakeCase($field)] = $value;
            }
        }

        return json_encode($document);
    }

    /**
     * to snake case
     *
     * @param string $string
     *
     * @return string
     */
    protected function toSnakeCase(string $string): string
    {
        return mb_strtolower(preg_replace('/(.)(?=[A-Z])/', '$1_', $string));
    }
}
