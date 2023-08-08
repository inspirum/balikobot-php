<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use GuzzleHttp\Psr7\Response;
use Inspirum\Balikobot\Client\Requester;
use LengthException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub\ConsecutiveCalls;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback;
use PHPUnit\Framework\MockObject\Stub\Stub;
use PHPUnit\Framework\TestCase;
use function array_map;
use function count;
use function func_get_args;
use function is_array;
use function json_encode;
use function range;
use function sprintf;

abstract class BaseTestCase extends TestCase
{
    /**
     * Get partial mocked API requester instance with overridden call method.
     *
     * @param int                 $statusCode
     * @param array<mixed>|string $response
     * @param array<mixed>|null   $request
     *
     * @return \Inspirum\Balikobot\Client\Requester&\PHPUnit\Framework\MockObject\MockObject
     */
    protected function newRequester(int $statusCode, array|string $response, ?array $request = null): Requester&MockObject
    {
        $requester = $this->createMock(Requester::class);

        if (is_array($response)) {
            $response = json_encode($response);
        }

        $invocation = $requester->expects(self::atMost(1))->method('request');
        if ($request !== null) {
            $invocation = $invocation->with(...$request);
        }

        $invocation->willReturn(new Response($statusCode, [], (string) $response));

        return $requester;
    }

    protected function assertNoException(): void
    {
        $this->addToAssertionCount(1);
    }

    /**
     * @param array<array<int,mixed>> $arguments
     */
    protected static function withConsecutive(array $arguments, mixed $responses = null): Stub
    {
        if (is_array($responses) && count($arguments) !== count($responses)) {
            throw new LengthException('Arguments and responses arrays must be same length');
        }

        if (!is_array($responses)) {
            $responses = array_map(static fn() => $responses, $arguments);
        }

        $values = array_map(static fn(array $arguments, mixed $response, int $i): ReturnCallback => new ReturnCallback(static function () use ($arguments, $response, $i) {
            self::assertSame(
                $arguments,
                func_get_args(),
                sprintf('Parameters for invocation #%d does not match expected value.', $i),
            );

            return $response;
        }), $arguments, $responses, range(0, count($arguments) - 1));

        return new ConsecutiveCalls($values);
    }
}
