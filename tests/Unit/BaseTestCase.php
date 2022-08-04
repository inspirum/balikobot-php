<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use GuzzleHttp\Psr7\Response;
use Inspirum\Balikobot\Client\Requester;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use function is_array;
use function json_encode;

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
}
