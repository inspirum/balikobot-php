<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use DateTime;
use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class OrderPickupMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->orderPickup('cp', new DateTime(), new DateTime('+4 HOURS'), 1, 2);
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->orderPickup('cp', new DateTime(), new DateTime('+4 HOURS'), 1, 2);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->orderPickup('cp', new DateTime(), new DateTime('+4 HOURS'), 1, 2);
    }

    public function testThrowsExceptionOnMessage(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
            'message' => 'Tato metoda není u dopravce podporována.',
        ]);

        $client->orderPickup('cp', new DateTime(), new DateTime('+4 HOURS'), 1, 2);
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->orderPickup(
            'cp',
            new DateTime('2018-10-10 14:10:00'),
            new DateTime('2018-12-10 20:20:00'),
            1,
            2,
            'TEST'
        );

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/orderpickup',
                [
                    'date'          => '2018-10-10',
                    'time_from'     => '14:10',
                    'time_to'       => '20:20',
                    'weight'        => 1,
                    'package_count' => 2,
                    'message'       => 'TEST',
                ],
            ]
        );

        self::assertTrue(true);
    }
}
