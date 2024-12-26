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

namespace D3\GuzzleFactory\tests;

use D3\GuzzleFactory\GuzzleFactory;
use Generator;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use ReflectionException;

trait LoggerTestTrait
{
    /**
     * @test
     * @throws ReflectionException
     * @covers       \D3\GuzzleFactory\GuzzleFactory::addFileLogger
     * @dataProvider addFileLoggerDataProvider
     */
    public function testAddFileLogger(int $logLevel, ?int $maxFiles, string $expectedHandlerClass): void
    {
        $sut = GuzzleFactory::create();

        $this->callMethod(
            $sut,
            'addFileLogger',
            ['nameFixture', 'file/path.log', $logLevel, $maxFiles]
        );

        $loggers = $this->getValue($sut, 'loggers');
        $this->assertArrayHasKey('nameFixture', $loggers);
        $this->assertInstanceOf(Logger::class, $loggers['nameFixture']);
        $this->assertInstanceOf($expectedHandlerClass, $loggers['nameFixture']->getHandlers()[0]);
        $this->assertSame($logLevel, $loggers['nameFixture']->popHandler('nameFixture')->getLevel());
    }

    public static function addFileLoggerDataProvider(): Generator
    {
        yield 'no rotation' => [Logger::INFO, null, StreamHandler::class];
        yield 'rotation 1' => [Logger::ERROR, 1, RotatingFileHandler::class];
        yield 'rotation 20' => [Logger::DEBUG, 20, RotatingFileHandler::class];
    }

    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::addConfiguredLogger
     * @covers \D3\GuzzleFactory\GuzzleFactory::getLoggers
     */
    public function testAddConfiguredLogger(): void
    {
        $loggerFixture = new Logger('fixturename');
        $loggerFixture->pushHandler(new StreamHandler('log.log', Logger::DEBUG));

        $sut = GuzzleFactory::create();
        $this->callMethod(
            $sut,
            'addConfiguredLogger',
            [$loggerFixture]
        );

        $loggers = $this->callMethod(
            $sut,
            'getLoggers',
        );
        $logger = $loggers[array_key_first($loggers)];

        $this->assertSame($loggerFixture, $logger);
    }

    /**
     * @test
     * @param int $level
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::setMessageLevel
     * @covers \D3\GuzzleFactory\GuzzleFactory::getMessageLevel
     * @dataProvider setGetMessageLevelDataProvider
     */
    public function testSetGetMessageLevel(int $level): void
    {
        $sut = GuzzleFactory::create();

        $this->callMethod(
            $sut,
            'setMessageLevel',
            [$level]
        );

        $this->assertSame(
            $level,
            $this->callMethod(
                $sut,
                'getMessageLevel',
            )
        );
    }

    public static function setGetMessageLevelDataProvider(): Generator
    {
        yield 'info'     => [Logger::INFO];
        yield 'error'    => [Logger::ERROR];
    }
}
