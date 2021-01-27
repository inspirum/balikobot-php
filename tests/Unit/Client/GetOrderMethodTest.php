<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class GetOrderMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getOrder('cp', 1);
    }

    public function testRequestDoesNotHaveStatus()
    {
        $client = $this->newMockedClient(200, [
            'order_id' => 29,
        ]);

        $order = $client->getOrder('cp', 1);

        $this->assertNotEmpty($order);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getOrder('cp', 1);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getOrder('cp', 1);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/orderview/1', []]
        );

        $this->assertTrue(true);
    }

    public function testOnlyOrderDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
            'status'       => 200,
            'order_id'     => 29,
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => ['1', '4', '65'],
        ]);

        $order = $client->getOrder('cp', 1);

        $this->assertEquals(
            [
                'order_id'     => 29,
                'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
                'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
                'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
                'package_ids'  => ['1', '4', '65'],
            ],
            $order
        );
    }
}
