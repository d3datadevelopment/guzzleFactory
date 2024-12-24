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

namespace D3\GuzzleFactory;

use D3\SensitiveMessageFormatter\sensitiveMessageFormatter;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\MessageFormatterInterface;

trait MessageFormatterTrait
{
    protected ?MessageFormatterInterface $formatter = null;

    protected function getMessageFormatter(): MessageFormatterInterface
    {
        return $this->formatter ?? $this->getDefaultMessageFormatter();
    }

    /**
     * @param string|null $template
     * @param string[]|null $anonymisations
     * @param string|null $replaceChar
     * @return void
     */
    public function setMessageFormatter(?string $template, ?array $anonymisations = null, ?string $replaceChar = null): void
    {
        $template ??= $this->getDefaultFormatterTemplate();

        $this->formatter =
            is_null($anonymisations) ?
                $this->getDefaultMessageFormatter($template) :
                new sensitiveMessageFormatter(
                    $template,
                    $anonymisations,
                    $replaceChar
                );
    }

    protected function getDefaultMessageFormatter(?string $template = null): MessageFormatterInterface
    {
        $template ??= $this->getDefaultFormatterTemplate();
        return new MessageFormatter(
            $template,
        );
    }

    protected function getDefaultFormatterTemplate(): string
    {
        return '{method} {uri} HTTP/{version} {req_body}'.PHP_EOL.'RESPONSE: {code} - {res_body}';
    }
}
