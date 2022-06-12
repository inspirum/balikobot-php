<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetAddAttributesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getAddAttributes('cp');
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getAddAttributes('cp');
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getAddAttributes('cp');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ], [
            'https://api.balikobot.cz/cp/addattributes',
            [],
        ]);

        $client = new Client($requester);

        $client->getAddAttributes('cp');

        self::assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfServiceTypesMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $services = $client->getAddAttributes('cp');

        self::assertEquals([], $services);
    }

    public function testOnlyServicesDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
            'status'     => 200,
            'attributes' => [
                '0' => [
                    'name'       => 'eid',
                    'data_type'  => 'string',
                    'max_length' => 40,
                ],
                '1' => [
                    'name'       => 'services',
                    'data_type'  => 'plus_separated_values',
                    'max_length' => null,
                ],
                '2' => [
                    'name'       => 'vs',
                    'data_type'  => 'int',
                    'max_length' => 10,
                ],
            ],
        ]);

        $services = $client->getAddAttributes('cp');

        self::assertEquals(
            [
                'eid'      => [
                    'name'       => 'eid',
                    'data_type'  => 'string',
                    'max_length' => 40,
                ],
                'services' => [
                    'name'       => 'services',
                    'data_type'  => 'plus_separated_values',
                    'max_length' => null,
                ],
                'vs'       => [
                    'name'       => 'vs',
                    'data_type'  => 'int',
                    'max_length' => 10,
                ],
            ],
            $services
        );
    }
}
