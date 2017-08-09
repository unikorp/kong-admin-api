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
 * configurator interface
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
interface ConfiguratorInterface
{
    /**
     * get base uri
     *
     * @return string
     */
    public function getBaseUri(): string;

    /**
     * get node
     *
     * @param string $name
     *
     * @return string
     */
    public function getNode(string $name): string;
}
