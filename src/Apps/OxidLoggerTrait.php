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

namespace D3\GuzzleFactory\Apps;

use OxidEsales\Eshop\Core\Registry;
use RuntimeException;

trait OxidLoggerTrait
{
    public function addOxidLogger(): void
    {
        if (!class_exists(Registry::class)) {
            throw new RuntimeException(__METHOD__.' can executed in OXID eShop installations only');
        }

        $this->loggers['oxid'] = Registry::getLogger();
    }

    public function getOxidLogPath(string $fileName): string
    {
        if (!class_exists(Registry::class)) {
            throw new RuntimeException(__METHOD__.' can executed in OXID eShop installations only');
        }

        return OX_BASE_PATH . '/log' . DIRECTORY_SEPARATOR . $fileName;
    }
}
