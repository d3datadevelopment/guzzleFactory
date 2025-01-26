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

namespace D3\GuzzleFactory\tests\Apps;

use D3\GuzzleFactory\GuzzleFactory;
use Monolog\Logger;
use ReflectionException;
use RuntimeException;

trait OxidLoggerTestTrait
{
    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::addOxidLogger
     */
    public function testAddOxidLoggerWithoutOxid(): void
    {
        $sut = GuzzleFactory::create();

        $this->expectException(RuntimeException::class);

        $this->callMethod(
            $sut,
            'addOxidLogger',
        );
    }

    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::addCombinedOxidAndFileLogger
     */
    public function testAddCombinedOxidAndFileLoggerWithoutOxid(): void
    {
        $sut = GuzzleFactory::create();

        $this->expectException(RuntimeException::class);

        $this->callMethod(
            $sut,
            'addCombinedOxidAndFileLogger',
            ['nameFixture', 'file/path.log', 1, 5]
        );
    }

    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::getOxidLogPath
     */
    public function testGetOxidLogPathWithoutOxid(): void
    {
        $sut = GuzzleFactory::create();

        $this->expectException(RuntimeException::class);

        $this->assertSame(
            'foo',
            $this->callMethod(
                $sut,
                'getOxidLogPath',
                ['fixture.log']
            )
        );
    }

    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::addOxidLogger
     */
    public function testAddOxidLoggerInOxid(): void
    {
        require_once __DIR__.'/../Helpers/classAliases.php';

        $sut = GuzzleFactory::create();

        $this->callMethod(
            $sut,
            'addOxidLogger',
        );

        $loggers = $this->getValue($sut, 'loggers');
        $this->assertArrayHasKey('oxid', $loggers);
        $this->assertInstanceOf(Logger::class, $loggers['oxid']);
    }

    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::addCombinedOxidAndFileLogger
     */
    public function testAddCombinedOxidAndFileLoggerInOxid(): void
    {
        require_once __DIR__.'/../Helpers/classAliases.php';

        $sut = GuzzleFactory::create();

        $this->setValue($sut, 'loggers', ['oxid' => 1]);

        $this->callMethod(
            $sut,
            'addCombinedOxidAndFileLogger',
            ['nameFixture', 'file/path.log', 1, 5]
        );

        $loggers = $this->getValue($sut, 'loggers');
        $this->assertArrayHasKey('nameFixture', $loggers);
        $this->assertArrayNotHasKey('oxid', $loggers);
        $this->assertInstanceOf(Logger::class, $loggers['nameFixture']);
    }

    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::getOxidLogPath
     */
    public function testGetOxidLogPathInOxid(): void
    {
        require_once __DIR__.'/../Helpers/classAliases.php';

        $sut = GuzzleFactory::create();

        $this->assertStringEndsWith(
            'tests/Helpers/log/fixture.log',
            $this->callMethod(
                $sut,
                'getOxidLogPath',
                ['fixture.log']
            )
        );
    }
}
