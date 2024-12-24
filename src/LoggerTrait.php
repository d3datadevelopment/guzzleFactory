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

use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use OxidEsales\Eshop\Core\Registry;
use Psr\Log\LoggerInterface;

trait LoggerTrait
{
    /** @var LoggerInterface[]  */
    protected array $loggers = [];
    protected ?int $messageLevel = null;

    public function addOxidLogger(): void
    {
        $this->loggers['oxid'] = Registry::getLogger();
    }

    public function addFileLogger(string $loggerName, string $fileName, int $logLevel = Logger::INFO, ?int $maxFiles = null): void
    {
        $logger = new Logger($loggerName);
        $stream_handler = is_null($maxFiles) ?
            new StreamHandler(
                OX_BASE_PATH . 'log' . DIRECTORY_SEPARATOR . $fileName,
                $logLevel
            ) :
            new RotatingFileHandler(
                OX_BASE_PATH . 'log' . DIRECTORY_SEPARATOR . $fileName,
                $maxFiles,
                $logLevel
            );
        $logger->pushHandler($stream_handler);

        $this->loggers[$loggerName] = $logger;
    }

    public function addConfiguredLogger(LoggerInterface $logger): void
    {
        $this->loggers[md5(serialize($logger))] = $logger;
    }

    /**
     * @return LoggerInterface[]
     */
    protected function getLoggers(): array
    {
        return $this->loggers;
    }

    protected function getMessageLevel(): int
    {
        return $this->messageLevel ?? Logger::INFO;
    }

    public function setMessageLevel(?int $messageLevel): void
    {
        $this->messageLevel = $messageLevel;
    }
}
