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

use GuzzleHttp\Utils;

trait HeaderTrait
{
    protected ?string $userAgent = null;
    protected ?string $contentType = null;
    protected ?string $accept = null;

    protected function getAccept(): string
    {
        return $this->accept ?? 'application/json';
    }

    public function setAccept(?string $accept): void
    {
        $this->accept = $accept;
    }

    protected function getContentType(): string
    {
        return $this->contentType ?? 'application/json';
    }

    public function setContentType(?string $contentType): void
    {
        $this->contentType = $contentType;
    }

    protected function getUserAgent(): string
    {
        return $this->userAgent ?? Utils::defaultUserAgent();
    }

    public function setUserAgent(?string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }
}
