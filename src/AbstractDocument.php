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
     * get fields
     *
     * @return array
     */
    abstract protected function getFields(): array;

    /**
     * to json
     *
     * @return string
     */
    public function toJson(): string
    {
        $document = [];

        foreach ($this->getFields() as $field) {
            if (!is_null($value = $this->$field)) {
                $document[$this->toSnakeCase($field)] = $this->$field;
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
    private function toSnakeCase(string $string): string
    {
        return mb_strtolower(preg_replace('/(.)(?=[A-Z])/', '$1_', $string));
    }
}
