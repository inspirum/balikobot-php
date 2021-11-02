<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client\Request;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class OrderB2AShipmentMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->orderB2AShipment('ppl', [['eid' => 1]]);
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->orderB2AShipment('ppl', [['eid' => 1]]);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
            0        => [
                'package_id'     => '24',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ]);

        $client->orderB2AShipment('ppl', [['eid' => 1]]);
    }

    public function testThrowsExceptionWhenNoReturnPackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
                'status' => 200,
            ],
        ]);

        $client->orderB2AShipment('ppl', [['eid' => 1]]);
    }

    public function testThrowsExceptionWhenBadResponseData(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
                'package_id' => '24',
                'status'     => 200,
            ],
            1        => [
                'status' => 200,
            ],
        ]);

        $client->orderB2AShipment('ppl', [['eid' => 1], ['eid' => 2]]);
    }

    public function testThrowsExceptionWhenWrongNumberOfPackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
                'package_id'     => '24',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
            1        => [
                'package_id'     => '24',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ]);

        $client->orderB2AShipment('ppl', [['test' => 1]]);
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'package_id'     => '24',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ]);

        $client = new Client($requester);

        $client->orderB2AShipment('ppl', [['data' => [1, 2, 3], 'test' => false]]);

        $requester->shouldHaveReceived(
            'request',
            ['https://api.balikobot.cz/ppl/b2a', [['data' => [1, 2, 3], 'test' => false]]]
        );

        self::assertTrue(true);
    }

    public function testOnlyPackagesDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
            0        => [
                'package_id'     => '24',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
            1        => [
                'carrier_id'     => '82161058244',
                'package_id'     => '25',
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ]);

        $packages = $client->orderB2AShipment('ppl', [['eid' => '0001'], ['eid' => '0002']]);

        self::assertEquals(
            [
                0 => [
                    'package_id'     => '24',
                    'status_message' => 'OK, přeprava byla objednána.',
                    'status'         => '200',
                ],
                1 => [
                    'carrier_id'     => '82161058244',
                    'package_id'     => '25',
                    'status_message' => 'OK, přeprava byla objednána.',
                    'status'         => '200',
                ],
            ],
            $packages
        );
    }
}
