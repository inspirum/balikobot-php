<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class OrderRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->orderShipment('cp', [1]);
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->orderShipment('cp', [1]);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->orderShipment('cp', [1]);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->orderShipment('cp', [1, 4]);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/order',
                [
                    'package_ids' => [1, 4],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testOnlyOrderDataAreReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'labels_url'   => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
            'order_id'     => 29,
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'package_ids'  => [1],
        ]);

        $client = new Client($requester);

        $order = $client->orderShipment('cp', [1]);

        $this->assertEquals(
            [
                'labels_url'   => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                'order_id'     => 29,
                'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
                'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
                'package_ids'  => [1],
            ],
            $order
        );
    }
}
