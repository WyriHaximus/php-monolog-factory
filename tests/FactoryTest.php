<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\Monolog;

use ColinODell\PsrTestLogger\TestLogger;
use PHPUnit\Framework\Attributes\Test;
use Psr\Log\LogLevel;
use WyriHaximus\Monolog\Factory;
use WyriHaximus\TestUtilities\TestCase;

use function array_key_exists;
use function is_array;
use function strtoupper;

final class FactoryTest extends TestCase
{
    #[Test]
    public function log(): void
    {
        $handler = new TestLogger();

        Factory::create('name', $handler, ['value' => 'key'])->log(LogLevel::EMERGENCY, 'YOU\'RE FIRED', ['key' => 'value']);

        self::assertTrue($handler->hasEmergencyRecords());
        self::assertTrue($handler->hasEmergencyThatContains('[name] ' . strtoupper(LogLevel::EMERGENCY) . ': YOU\'RE FIRED'));
        self::assertTrue($handler->hasEmergencyThatPasses(static fn (array $record): bool => array_key_exists('context', $record) &&
            is_array($record['context']) &&
            array_key_exists('key', $record['context']) && $record['context']['key'] === 'value' &&
            array_key_exists('extra', $record['context']) &&
            is_array($record['context']['extra']) &&
            array_key_exists('memory_peak_usage', $record['context']['extra']) &&
            array_key_exists('memory_usage', $record['context']['extra']) &&
            array_key_exists('file', $record['context']['extra']) &&
            array_key_exists('line', $record['context']['extra']) &&
            array_key_exists('class', $record['context']['extra']) &&
            array_key_exists('function', $record['context']['extra']) &&
            array_key_exists('process_id', $record['context']['extra']) &&
            array_key_exists('runtime', $record['context']['extra']) &&
            array_key_exists('value', $record['context']['extra']) && $record['context']['extra']['value'] === 'key'));
    }
}
