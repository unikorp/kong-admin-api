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
 * target
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Target extends AbstractDocument
{
    /**
     * target
     * @var string $target
     */
    protected $target = null;

    /**
     * weight
     * @var int $weight
     */
    protected $weight = 100;

    /**
     * set target
     *
     * @param string $target
     *
     * @return this
     */
    public function setTarget(string $target): self
    {
        $this->target = $target;

        return $this;
    }

    /**
     * get target
     *
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * set weight
     *
     * @param int $weight
     *
     * @return this
     */
    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * get weight
     *
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * get fields
     *
     * @return array
     */
    protected function getFields(): array
    {
        return [
            'target',
            'weight',
        ];
    }
}
