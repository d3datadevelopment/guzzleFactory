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

namespace D3\GuzzleFactory\tests;

use D3\GuzzleFactory\GuzzleFactory;
use D3\GuzzleFactory\tests\Apps\OxidLoggerTestTrait;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Monolog\Logger;
use ReflectionException;

/**
 * @coversNothing
 */
class GuzzleFactoryTest extends ApiTestCase
{
    use HeaderTestTrait;
    use LoggerTestTrait;
    use MessageFormatterTestTrait;
    use OxidLoggerTestTrait;

    /**
     * @test
     * @return void
     * @covers \D3\GuzzleFactory\GuzzleFactory::create
     */
    public function testCreate(): void
    {
        $instance = GuzzleFactory::create();

        $this->assertInstanceOf(GuzzleFactory::class, $instance);
    }

    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::getGuzzle
     */
    public function testGetGuzzle(): void
    {
        $sutMock = $this->getMockBuilder(GuzzleFactory::class)
            ->onlyMethods(['getStack', 'getContentType', 'getAccept', 'getUserAgent'])
            ->getMock();
        $sutMock->expects($this->once())->method('getStack');
        $sutMock->expects($this->once())->method('getContentType');
        $sutMock->expects($this->once())->method('getAccept');
        $sutMock->expects($this->once())->method('getUserAgent');

        $this->assertInstanceOf(
            Client::class,
            $this->callMethod(
                $sutMock,
                'getGuzzle',
                ['https://google.com']
            )
        );
    }

    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::getStack
     */
    public function testGetStack()
    {
        $sutMock = $this->getMockBuilder(GuzzleFactory::class)
            ->onlyMethods(['getLoggers', 'getMessageLevel', 'getMessageFormatter'])
            ->getMock();
        $sutMock->expects($this->once())->method('getLoggers')->willReturn([
            new Logger('logger1'), new Logger('logger2'),
        ]);
        $sutMock->expects($this->exactly(2))->method('getMessageLevel')->willReturn(Logger::INFO);
        $sutMock->expects($this->exactly(2))->method('getMessageFormatter');

        $this->assertInstanceOf(
            HandlerStack::class,
            $this->callMethod(
                $sutMock,
                'getStack'
            )
        );
    }
}
