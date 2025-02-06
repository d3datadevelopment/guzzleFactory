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

use D3\GuzzleFactory\Apps\OxidLoggerTrait;
use D3\LoggerFactory\LoggerFactory;
use Exception;
use InvalidArgumentException;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

trait LoggerTrait
{
    use OxidLoggerTrait;

    /** @var LoggerInterface[]  */
    protected array $loggers = [];
    protected ?int $messageLevel = null;

    protected function getLoggerFactory(): LoggerFactory
    {
        return LoggerFactory::create();
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function addFileLogger(
        string $loggerName,
        string $filePath,
        int $logLevel = Logger::INFO,
        ?int $maxFiles = null,
        array $specialHandlers = []     // see LoggerFactory constants
    ): void
    {
        $this->loggers[$loggerName] = $this->getLoggerFactory()
            ->getFileLogger($loggerName, $filePath, $logLevel, $maxFiles, $specialHandlers);
    }

    /**
     * @deprecated use LoggerFactory::getFileLoggerStreamHandler
     * @param string $filePath
     * @param int $logLevel
     * @param int|null $maxFiles
     * @return AbstractProcessingHandler
     * @throws Exception
     */
    public function getFileLoggerStreamHandler(
        string $filePath,
        int $logLevel = Logger::INFO,
        ?int $maxFiles = null
    ): AbstractProcessingHandler
    {
        return $this->getLoggerFactory()->getFileLoggerStreamHandler($filePath, $logLevel, $maxFiles);
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
