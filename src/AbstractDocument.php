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
    const DEFAULT_FIELDS = ['createdAt', 'size', 'offset'];

    /**
     * created at
     * @param int $createdAt
     */
    protected $createdAt = null;

    /**
     * size
     * @param int $size
     */
    protected $size = null;

    /**
     * offset
     * @param string $offset
     */
    protected $offset = null;

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
    public function setCreatedAt(int $createdAt)
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
     * set size
     *
     * @param int $size
     *
     * @return this
     */
    public function setSize(int $size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * get size
     *
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * set offset
     *
     * @param string $offset
     *
     * @return this
     */
    public function setOffset(string $offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * get offset
     *
     * @return string
     */
    public function getOffset(): string
    {
        return $this->offset;
    }

    /**
     * to json
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toRequestParameters());
    }

    /**
     * to query string
     *
     * @return string
     */
    public function toQueryString(): string
    {
        return http_build_query($this->toRequestParameters());
    }

    /**
     * to request parameters
     *
     * @return array
     */
    protected function toRequestParameters(): array
    {
        $requestParameters = [];

        foreach (array_merge($this->getFields(), self::DEFAULT_FIELDS) as $field) {
            if (!is_null($value = $this->$field)) {
                $requestParameters[$this->toSnakeCase($field)] = $value;
            }
        }

        return $requestParameters;
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
