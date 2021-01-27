<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetOrderMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'order_id'     => 29,
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => ['1', '4', '65'],
        ]);

        $service = new Balikobot($requester);

        $service->getOrder('cp', 1);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/orderview/1',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $service = $this->newMockedBalikobot(200, [
            'status'       => 200,
            'order_id'     => 29,
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => ['1', '4', '65'],
        ]);

        $orderedShipment = $service->getOrder('ppl', 29);

        $this->assertEquals(29, $orderedShipment->getOrderId());
        $this->assertEquals('http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..', $orderedShipment->getFileUrl());
        $this->assertEquals('http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.', $orderedShipment->getHandoverUrl());
        $this->assertEquals('http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ', $orderedShipment->getLabelsUrl());
        $this->assertEquals(['1', '4', '65'], $orderedShipment->getPackageIds());
        $this->assertEquals('ppl', $orderedShipment->getShipper());
    }
}
