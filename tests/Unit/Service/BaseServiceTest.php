<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Tests\BaseTestCase;
use function array_replace;

abstract class BaseServiceTest extends BaseTestCase
{
    /**
     * @param array<mixed>        $arguments
     * @param array<string,mixed> $response
     */
    protected function mockClient(array $arguments, array $response): Client
    {
        $arguments = array_replace([
            null,
            null,
            null,
            [],
            null,
            true,
            false,
        ], $arguments);

        $client = $this->createMock(Client::class);
        $client->expects(self::once())->method('call')->with(...$arguments)->willReturn($response);

        return $client;
    }
}
