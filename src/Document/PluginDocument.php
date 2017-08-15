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
 * plugin document
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class PluginDocument extends AbstractDocument
{
    /**
     * name
     * @var string $name
     */
    protected $name = null;

    /**
     * consumer id
     * @var string $consumerId
     */
    protected $consumerId = null;

    /**
     * config
     * @var array $config
     */
    protected $config = [];

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
     * set consumer id
     *
     * @param string $consumerId
     *
     * @return this
     */
    public function setConsumerId(string $consumerId): self
    {
        $this->consumerId = $consumerId;

        return $this;
    }

    /**
     * get consumer id
     *
     * @return string
     */
    public function getConsumerId(): string
    {
        return $this->consumerId;
    }

    /**
     * add config
     *
     * @param string $name
     * @param mixed $value
     *
     * @return this
     */
    public function addConfig(string $name, $value): self
    {
        if (isset($this->config[$name])) {
            throw new \RuntimeException(sprintf('Config for name `%1$s` already set', $name));
        }

        $this->config[$name] = $value;

        return $this;
    }

    /**
     * remove config
     *
     * @param string $name
     *
     * @return this
     */
    public function removeConfig(string $name): self
    {
        if (isset($this->config[$name])) {
            unset($this->config[$name]);
        }

        return $this;
    }

    /**
     * get config
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getConfig(string $name)
    {
        return $this->config[$name];
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
            'consumerId',
            'config',
        ];
    }

    /**
     * to request parameters
     *
     * @return array
     */
    public function toRequestParameters(): array
    {
        $requestParameters = [];

        foreach (array_merge($this->getFields(), self::DEFAULT_FIELDS) as $field) {
            if (!is_null($value = $this->$field)) {
                if (is_array($value)) {
                    foreach (array_keys($value) as $key) {
                        $requestParameters[$this->toSnakeCase(sprintf('%1$s.%2$s', $field, $key))] = $value[$key];
                    }

                    continue;
                }

                $requestParameters[$this->toSnakeCase($field)] = $this->$field;
            }
        }

        return $requestParameters;
    }
}
