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
 * upstream
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class Upstream extends AbstractDocument
{
    /**
     * name
     * @var string $name
     */
    protected $name = null;

    /**
     * slots
     * @var int $slots
     */
    protected $slots = 1000;

    /**
     * orderlist
     * @var array $orderlist
     */
    protected $orderlist = [];

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
     * set slots
     *
     * @param int $slots
     *
     * @return this
     */
    public function setSlots(int $slots): self
    {
        $this->slots = $slots;

        return $this;
    }

    /**
     * get slots
     *
     * @return int
     */
    public function getSlots(): int
    {
        return $this->slots;
    }

    /**
     * set orderlist
     *
     * @param array $orderlist
     *
     * @return this
     */
    public function setOrderlist(array $orderlist): self
    {
        $this->orderlist = $orderlist;

        return $this;
    }

    /**
     * get orderlist
     *
     * @return array
     */
    public function getOrderlist(): array
    {
        return $this->orderlist;
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
            'slots',
            'orderlist',
        ];
    }
}
