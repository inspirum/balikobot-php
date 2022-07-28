<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Tests\BaseTestCase;
use function array_map;
use function array_replace;
use function count;
use function uniqid;

abstract class BaseServiceTest extends BaseTestCase
{
    /**
     * @return array<string,mixed>
     */
    protected function mockClientResponse(): array
    {
        return ['data' => uniqid(more_entropy: true)];
    }

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

    /**
     * @param array<array<mixed>>        $multipleArguments
     * @param array<array<string,mixed>> $responses
     */
    protected function mockClientMultipleCalls(array $multipleArguments, array $responses): Client
    {
        $client = $this->createMock(Client::class);
        $client->expects(self::exactly(count($multipleArguments)))->method('call')->withConsecutive(...array_map(static fn(array $arguments): array => array_replace([
            null,
            null,
            null,
            [],
            null,
            true,
            false,
        ], $arguments), $multipleArguments))->willReturnOnConsecutiveCalls(...$responses);

        return $client;
    }
}
