<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use GuzzleHttp\Psr7\Response;
use Inspirum\Balikobot\Client\Requester;
use LengthException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback;
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

    /**
     * @param array<array<int,mixed>> $arguments
     * @param array<mixed>            $responses
     *
     * @return array<\PHPUnit\Framework\MockObject\Stub\Stub>
     */
    protected function withConsecutive(array $arguments, array $responses): array
    {
        if (count($arguments) !== count($responses)) {
            throw new LengthException('Arguments and responses arrays must be same length');
        }

        return array_map(fn(array $arguments, mixed $response, int $i): ReturnCallback => new ReturnCallback(function () use ($arguments, $response, $i) {
            $this->assertSame(
                $arguments,
                func_get_args(),
                sprintf('Parameters for invocation #%d does not match expected value.', $i),
            );

            return $response;
        }), $arguments, $responses, range(0, count($arguments) - 1));
    }
}
