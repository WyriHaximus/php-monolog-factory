<?php

declare(strict_types=1);

namespace WyriHaximus\Monolog;

use Bramus\Monolog\Formatter\ColoredLineFormatter;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Processor;
use Psr\Log\LoggerInterface;
use WyriHaximus\Monolog\FormattedPsrHandler\FormattedPsrHandler;
use WyriHaximus\Monolog\Processors\ExceptionClassProcessor;
use WyriHaximus\Monolog\Processors\KeyValueProcessor;
use WyriHaximus\Monolog\Processors\RuntimeProcessor;
use WyriHaximus\Monolog\Processors\ToContextProcessor;
use WyriHaximus\Monolog\Processors\TraceProcessor;

use const WyriHaximus\Constants\Boolean\FALSE_;
use const WyriHaximus\Constants\Boolean\TRUE_;

final class Factory
{
    /** @param array<string, mixed> $keyValuePairs */
    public static function create(string $name, LoggerInterface $handler, array $keyValuePairs): Logger
    {
        $logger = new Logger($name);
        $logger->pushProcessor(new ToContextProcessor());
        $logger->pushProcessor(new TraceProcessor());

        /** @psalm-suppress MixedAssignment */
        foreach ($keyValuePairs as $key => $value) {
            $logger->pushProcessor(new KeyValueProcessor($key, $value));
        }

        $logger->pushProcessor(new ExceptionClassProcessor());
        $logger->pushProcessor(new RuntimeProcessor());
        $logger->pushProcessor(new Processor\ProcessIdProcessor());
        $logger->pushProcessor(new Processor\IntrospectionProcessor(Level::Notice));
        $logger->pushProcessor(new Processor\MemoryUsageProcessor());
        $logger->pushProcessor(new Processor\MemoryPeakUsageProcessor());

        $consoleHandler = new FormattedPsrHandler($handler);
        /** @psalm-suppress InvalidArgument */
        $consoleHandler->setFormatter(new ColoredLineFormatter(
            null,
            '[%datetime%][%channel%] %level_name%: %message%', /** @phpstan-ignore-line */
            'Y-m-d H:i:s.u', /** @phpstan-ignore-line */
            TRUE_,
            FALSE_,
        ));
        $logger->pushHandler($consoleHandler);

        return $logger;
    }
}
