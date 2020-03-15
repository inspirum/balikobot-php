<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Requests;

use DateTime;
use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;
use PHPUnit\Framework\Error\Deprecated;

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
                    'date'        => null,
                    'note'        => null,
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithDeprecatedParameters()
    {
        $this->expectException(Deprecated::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->orderShipment('cp', [1, 4], new DateTime('2018-10-10 14:00:00'), 'TEST');
    }

    public function testMakeRequestWithDeprecatedParametersWorks()
    {
        $depracatedEnabled   = Deprecated::$enabled;
        Deprecated::$enabled = false;

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->orderShipment('cp', [1, 4], new DateTime('2018-10-10 14:00:00'), 'TEST');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/order',
                [
                    'package_ids' => [1, 4],
                    'date'        => '2018-10-10',
                    'note'        => 'TEST',
                ],
            ]
        );

        $this->assertTrue(true);

        Deprecated::$enabled = $depracatedEnabled;
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
