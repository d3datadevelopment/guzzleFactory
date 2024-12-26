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
use D3\SensitiveMessageFormatter\sensitiveMessageFormatter;
use Generator;
use GuzzleHttp\MessageFormatter;
use ReflectionException;

trait MessageFormatterTestTrait
{
    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::setMessageFormatter
     * @covers \D3\GuzzleFactory\GuzzleFactory::getMessageFormatter
     * @dataProvider setGetMessageFormatterDataProvider
     */
    public function testSetGetMessageFormatter(
        ?string $template,
        ?array $anonymizations,
        string $expectedFormatterClass,
        string $expectedTemplate
    ): void {
        $sut = GuzzleFactory::create();

        $this->callMethod(
            $sut,
            'setMessageFormatter',
            [$template, $anonymizations]
        );

        $formatter = $this->callMethod($sut, 'getMessageFormatter');
        $this->assertInstanceOf($expectedFormatterClass, $formatter);
        try {
            $this->assertSame($expectedTemplate, $this->getValue($formatter, 'template'));
        } catch (ReflectionException) {
            // can't get template from sensitiveMessagerFormater because it's in private scope
        }
    }

    /**
     * @return Generator
     * @throws ReflectionException
     */
    public static function setGetMessageFormatterDataProvider(): Generator
    {
        $sut = GuzzleFactory::create();
        $test = new GuzzleFactoryTest('fixture');
        yield 'no template, insensitive' => [
            null,
            null,
            MessageFormatter::class,
            $test->callMethod($sut, 'getDefaultFormatterTemplate'),
        ];
        yield 'cust template, insensitive' => [
            '{req_body}',
            null,
            MessageFormatter::class,
            '{req_body}',
        ];
        yield 'no template, sensitive' => [
            null,
            ['foo', 'bar'],
            sensitiveMessageFormatter::class,
            $test->callMethod($sut, 'getDefaultFormatterTemplate'),
        ];
        yield 'cust template, sensitive' => [
            '{req_body}',
            ['foo', 'bar'],
            sensitiveMessageFormatter::class,
            '{req_body}',
        ];
    }

    /**
     * @test
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::getDefaultMessageFormatter
     * @dataProvider getDefaultMessageFormatterProvider
     */
    public function testGetDefaultMessageFormatter(?string $template, string $expectedTemplate): void
    {
        $sut = GuzzleFactory::create();

        $formatter = $this->callMethod(
            $sut,
            'getDefaultMessageFormatter',
            [$template]
        );

        $this->assertInstanceOf(MessageFormatter::class, $formatter);
        $this->assertSame(
            $expectedTemplate,
            $this->getValue(
                $formatter,
                'template'
            )
        );
    }

    /**
     * @return Generator
     * @throws ReflectionException
     */
    public static function getDefaultMessageFormatterProvider(): Generator
    {
        $sut = GuzzleFactory::create();
        $test = new GuzzleFactoryTest('fixture');
        yield 'default' => [null, $test->callMethod($sut, 'getDefaultFormatterTemplate')];
        yield 'custom' => ['{req_body}', '{req_body}'];
    }

    /**
     * @test
     * @return void
     * @throws ReflectionException
     * @covers \D3\GuzzleFactory\GuzzleFactory::getDefaultFormatterTemplate
     */
    public function testGetDefaultFormatterTemplate(): void
    {
        $sut = GuzzleFactory::create();

        $template = $this->callMethod(
            $sut,
            'getDefaultFormatterTemplate',
        );

        $this->assertIsString($template);
        $this->assertTrue(strlen($template) > 50);
    }
}
