<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use function array_map;
use function array_replace;
use function count;
use function uniqid;

abstract class BaseServiceTestCase extends BaseTestCase
{
    /**
     * @return array<string,mixed>
     */
    protected function mockClientResponse(): array
    {
        return ['data' => uniqid(more_entropy: true)];
    }

    /**
     * @param array<mixed> $arguments
     * @param array<string,mixed>|null $response
     */
    protected function mockClient(array $arguments, ?array $response): Client
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
        if ($response !== null) {
            $client->expects(self::once())->method('call')->with(...$arguments)->willReturn($response);
        } else {
            $client->expects(self::never())->method('call');
        }

        return $client;
    }

    /**
     * @param array<array<mixed>> $multipleArguments
     * @param array<array<string,mixed>> $responses
     */
    protected function mockClientMultipleCalls(array $multipleArguments, array $responses): Client
    {
        $client = $this->createMock(Client::class);
        $client->expects(self::exactly(count($multipleArguments)))->method('call')
               ->will(self::withConsecutive(
                   array_map(static fn(array $arguments): array => array_replace([
                       null,
                       null,
                       null,
                       [],
                       null,
                       true,
                       false,
                   ], $arguments), $multipleArguments),
                   $responses,
               ));

        return $client;
    }
}
