<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetB2AServicesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getB2AServices('ppl');
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getB2AServices('ppl');
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getB2AServices('ppl');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getB2AServices('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/b2a/services',
                [],
            ]
        );

        self::assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfServiceTypesMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $services = $client->getB2AServices('ppl');

        self::assertEquals([], $services);
    }

    public function testOnlyUnitsDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
            'status'        => 200,
            'service_types' => [
                '1'  => 'PPL Parcel Business CZ',
                '11' => 'PPL Parcel Import SK',
            ],
        ]);

        $services = $client->getB2AServices('ppl');

        self::assertEquals(
            [
                '1'  => 'PPL Parcel Business CZ',
                '11' => 'PPL Parcel Import SK',
            ],
            $services
        );
    }
}
