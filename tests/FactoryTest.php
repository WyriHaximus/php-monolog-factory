<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\Monolog;

use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use WyriHaximus\Monolog\Factory;
use WyriHaximus\TestUtilities\TestCase;

use function array_key_exists;
use function strtoupper;

final class FactoryTest extends TestCase
{
    /** @test */
    public function log(): void
    {
        $handler = $this->prophesize(LoggerInterface::class);
        $handler->log(
            LogLevel::EMERGENCY,
            Argument::containingString('[name] ' . strtoupper(LogLevel::EMERGENCY) . ': YOU\'RE FIRED'),
            Argument::that(static function (array $context): bool {
                return array_key_exists('key', $context) && $context['key'] === 'value' &&
                    array_key_exists('extra', $context) &&
                    array_key_exists('memory_peak_usage', $context['extra']) &&
                    array_key_exists('memory_usage', $context['extra']) &&
                    array_key_exists('file', $context['extra']) &&
                    array_key_exists('line', $context['extra']) &&
                    array_key_exists('class', $context['extra']) &&
                    array_key_exists('function', $context['extra']) &&
                    array_key_exists('process_id', $context['extra']) &&
                    array_key_exists('runtime', $context['extra']) &&
                    array_key_exists('value', $context['extra']) && $context['extra']['value'] === 'key';
            }),
        )->shouldBeCalled();

        Factory::create('name', $handler->reveal(), ['value' => 'key'])->log(LogLevel::EMERGENCY, 'YOU\'RE FIRED', ['key' => 'value']);
    }
}
