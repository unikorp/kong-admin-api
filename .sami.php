<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in('./src')
;

return new Sami($iterator, [
    //'theme' => 'symfony',
    'title' => 'Unikorp Kong Admin API',
    'build_dir' => __DIR__.'/build/api',
    'cache_dir' => __DIR__.'/build/apicache',
    //'remote_repository' => new GitHubRemoteRepository('username/repository', '/path/to/repository'),
    //'default_opened_level' => 2,
]);
