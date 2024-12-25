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
use ReflectionException;

trait HeaderTestTrait
{
    /**
     * @test
     * @throws ReflectionException
     * @covers       \D3\GuzzleFactory\GuzzleFactory::getAccept
     * @dataProvider getAcceptDataProvider
     */
    public function testGetAccept(string $expected, bool $viaClassProperty): void
    {
        $sut = GuzzleFactory::create();

        if ($viaClassProperty) {
            $this->setValue($sut, 'accept', $expected);
        }

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'getAccept',
            )
        );
    }

    public static function getAcceptDataProvider(): Generator
    {
        yield 'default'     => ['application/json', false];
        yield 'via property' => ['application/xml', true];
    }

    /**
     * @test
     * @param string $expected
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::setAccept
     * @dataProvider setAcceptDataProvider
     */
    public function testSetAccept(string $expected): void
    {
        $sut = GuzzleFactory::create();
        $sut->setAccept($expected);

        $this->assertSame(
            $expected,
            $this->getValue($sut, 'accept')
        );
    }

    public static function setAcceptDataProvider(): Generator
    {
        yield 'default'     => ['application/json'];
        yield 'via property' => ['application/xml'];
    }

    /**
     * @test
     * @throws ReflectionException
     * @covers       \D3\GuzzleFactory\GuzzleFactory::getContentType
     * @dataProvider getAcceptDataProvider
     */
    public function testGetContentType(string $expected, bool $viaClassProperty): void
    {
        $sut = GuzzleFactory::create();

        if ($viaClassProperty) {
            $this->setValue($sut, 'contentType', $expected);
        }

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'getContentType',
            )
        );
    }

    /**
     * @test
     * @param string $expected
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::setContentType
     * @dataProvider setAcceptDataProvider
     */
    public function testSetContentType(string $expected): void
    {
        $sut = GuzzleFactory::create();
        $sut->setContentType($expected);

        $this->assertSame(
            $expected,
            $this->getValue($sut, 'contentType')
        );
    }

    /**
     * @test
     * @throws ReflectionException
     * @covers       \D3\GuzzleFactory\GuzzleFactory::getUserAgent
     * @dataProvider getUserAgentDataProvider
     */
    public function testGetUserAgent(string $expected, bool $viaClassProperty): void
    {
        $sut = GuzzleFactory::create();

        if ($viaClassProperty) {
            $this->setValue($sut, 'userAgent', $expected);
        }

        $this->assertSame(
            $expected,
            $this->callMethod(
                $sut,
                'getUserAgent',
            )
        );
    }

    public static function getUserAgentDataProvider(): Generator
    {
        yield 'default'     => ['GuzzleHttp/7', false];
        yield 'via property' => ['myApp/1.0.0', true];
    }

    /**
     * @test
     * @param string $expected
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::setUserAgent
     * @dataProvider setAcceptDataProvider
     */
    public function testSetUserAgent(string $expected): void
    {
        $sut = GuzzleFactory::create();
        $sut->setUserAgent($expected);

        $this->assertSame(
            $expected,
            $this->getValue($sut, 'userAgent')
        );
    }
}
