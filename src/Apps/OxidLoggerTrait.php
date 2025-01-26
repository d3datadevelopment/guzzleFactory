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

use Exception;
use InvalidArgumentException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
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

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function addCombinedOxidAndFileLogger(
        string $loggerName,
        string $filePath,
        int $logLevel = Logger::INFO,
        ?int $maxFiles = null
    ): void
    {
        if (!class_exists(Registry::class)) {
            throw new RuntimeException(__METHOD__.' can executed in OXID eShop installations only');
        }

        $logger = new Logger($loggerName);
        $stream_handler = $this->getFileLoggerStreamHandler($filePath, $logLevel, $maxFiles);
        $logger->pushHandler($stream_handler);

        $oxidLogFilePath = $this->getOxidLogPath('oxideshop.log');
        $oxidStreamHandler = new StreamHandler($oxidLogFilePath, Logger::ERROR);
        $logger->pushHandler($oxidStreamHandler);

        if (isset($this->loggers['oxid'])) {
            unset($this->loggers['oxid']);
        }

        $this->loggers[$loggerName] = $logger;
    }

    public function getOxidLogPath(string $fileName): string
    {
        if (!class_exists(Registry::class)) {
            throw new RuntimeException(__METHOD__.' can executed in OXID eShop installations only');
        }

        return OX_BASE_PATH . '/log' . DIRECTORY_SEPARATOR . $fileName;
    }
}
