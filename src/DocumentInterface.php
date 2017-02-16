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
 * document interface
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
interface DocumentInterface
{
    /**
     * to json
     *
     * @return string
     */
    public function toJson(): string;
}
