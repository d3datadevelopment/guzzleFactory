<?php

/**
 * Copyright (c) D3 Data Development (Inh. Thomas Dartsch)
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

declare(strict_types=1);

namespace D3\OxidGuzzleFactory\tests;

use D3\OxidGuzzleFactory\GuzzleFactory;

class GuzzleFactoryTest extends ApiTestCase
{
    /**
     * @test
     * @return void
     * @covers \D3\OxidGuzzleFactory\GuzzleFactory::create
     */
    public function testCreate(): void
    {
        $instance = GuzzleFactory::create();

        $this->assertInstanceOf(GuzzleFactory::class, $instance);
    }
}