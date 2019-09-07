<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Request;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class B2ARequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->orderB2AShipment('ppl', []);
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->orderB2AShipment('ppl', []);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
            0        => [
                'package_id'     => 24,
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ]);

        $client = new Client($requester);

        $client->orderB2AShipment('ppl', []);
    }

    public function testThrowsExceptionWhenNoReturnPackages()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'eid' => 200,
            ],
        ]);

        $client = new Client($requester);

        $client->orderB2AShipment('ppl', []);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'package_id'     => 24,
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ]);

        $client = new Client($requester);

        $client->orderB2AShipment('ppl', ['data' => [1, 2, 3], 'test' => false]);

        $requester->shouldHaveReceived(
            'request',
            ['https://api.balikobot.cz/ppl/b2a', ['data' => [1, 2, 3], 'test' => false]]
        );

        $this->assertTrue(true);
    }

    public function testOnlyPackagesDataAreReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'package_id'     => 24,
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
            1        => [
                'carrier_id'     => '82161058244',
                'package_id'     => 25,
                'status_message' => 'OK, přeprava byla objednána.',
                'status'         => '200',
            ],
        ]);

        $client = new Client($requester);

        $packages = $client->orderB2AShipment('ppl', []);

        $this->assertEquals(
            [
                0 => [
                    'package_id'     => 24,
                    'status_message' => 'OK, přeprava byla objednána.',
                    'status'         => '200',
                ],
                1 => [
                    'carrier_id'     => '82161058244',
                    'package_id'     => 25,
                    'status_message' => 'OK, přeprava byla objednána.',
                    'status'         => '200',
                ],
            ],
            $packages
        );
    }
}
