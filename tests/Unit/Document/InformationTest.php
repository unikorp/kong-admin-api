<?php

/*
 * This file is part of the KongAdminApi package.
 *
 * (c) Unikorp <https://github.com/unikorp>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unikorp\KongAdminApi\Tests\Unit\Document;

use Unikorp\KongAdminApi\Document\Information as Document;
use PHPUnit\Framework\TestCase;

/**
 * information test
 *
 * @author VEBER Arnaud <https://github.com/VEBERArnaud>
 */
class InformationTest extends TestCase
{
    /**
     * document
     * @var \Unikorp\KongAdminApi\Document\Information $document
     */
    private $document = null;

    /**
     * set up
     *
     * @return void
     *
     * @coversNothing
     */
    protected function setUp()
    {
        $this->document = new Document();
    }

    /**
     * tear down
     *
     * @return void
     *
     * @coversNothing
     */
    protected function tearDown()
    {
        $this->document = null;
    }

    /**
     * test to json
     *
     * @return void
     *
     * @covers \Unikorp\KongAdminApi\AbstractDocument::toJson
     * @covers \Unikorp\KongAdminApi\Document\Information::getFields
     */
    public function testToJson()
    {
        $this->assertSame('[]', $this->document->toJson());
    }
}
