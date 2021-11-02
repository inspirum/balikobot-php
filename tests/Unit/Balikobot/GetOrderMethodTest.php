<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetOrderMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'order_id'     => '29',
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => ['1', '4', '65'],
        ]);

        $service = new Balikobot($requester);

        $service->getOrder('cp', '1');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/orderview/1',
                [],
            ]
        );

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'       => 200,
            'order_id'     => '29',
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => ['1', '4', '65'],
        ]);

        $orderedShipment = $service->getOrder('ppl', '29');

        self::assertEquals('29', $orderedShipment->getOrderId());
        self::assertEquals('http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..', $orderedShipment->getFileUrl());
        self::assertEquals('http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.', $orderedShipment->getHandoverUrl());
        self::assertEquals('http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ', $orderedShipment->getLabelsUrl());
        self::assertEquals(['1', '4', '65'], $orderedShipment->getPackageIds());
        self::assertEquals('ppl', $orderedShipment->getShipper());
    }
}
