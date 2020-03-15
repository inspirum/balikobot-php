<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use DateTime;
use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;
use PHPUnit\Framework\Error\Deprecated;

class OrderShipmentTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'order_id'     => 29,
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => [1, 2],
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1234'));
        $packages->add(new OrderedPackage(2, 'ppl', '0001', '5678'));

        $service->orderShipment($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/order',
                [
                    'package_ids' => [1, 2],
                    'date'        => null,
                    'note'        => null,
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithDeprecatedParameter()
    {
        $this->expectException(Deprecated::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'order_id'     => 29,
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => [1, 2],
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1234'));
        $packages->add(new OrderedPackage(2, 'ppl', '0001', '5678'));

        $service->orderShipment($packages, new DateTime('2018-10-10 10:00:00'));
    }

    public function testMakeRequestWithDeprecatedParameterWorks()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'order_id'     => 29,
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => [1, 2],
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1234'));
        $packages->add(new OrderedPackage(2, 'ppl', '0001', '5678'));

        @$service->orderShipment($packages, new DateTime('2018-10-10 10:00:00'));

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/order',
                [
                    'note'        => null,
                    'date'        => '2018-10-10',
                    'package_ids' => [1, 2],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'order_id'     => 29,
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => [1, 2],
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1234'));
        $packages->add(new OrderedPackage(2, 'ppl', '0001', '5678'));

        $orderedShipment = $service->orderShipment($packages);

        $this->assertEquals('ppl', $orderedShipment->getShipper());
        $this->assertEquals([1, 2], $orderedShipment->getPackageIds());
        $this->assertEquals('http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..', $orderedShipment->getFileUrl());
        $this->assertEquals('http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ', $orderedShipment->getLabelsUrl());
        $this->assertEquals('http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.', $orderedShipment->getHandoverUrl());
        $this->assertEquals(29, $orderedShipment->getOrderId());
    }

    public function testResponseDataWithDepractedParameter()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'order_id'     => 29,
            'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
            'labels_url'   => 'http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ',
            'package_ids'  => [1, 2],
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1234'));
        $packages->add(new OrderedPackage(2, 'ppl', '0001', '5678'));

        @$orderedShipment = $service->orderShipment($packages, new DateTime('2018-10-10 10:00:00'));

        $this->assertEquals('ppl', $orderedShipment->getShipper());
        $this->assertEquals([1, 2], $orderedShipment->getPackageIds());
        $this->assertEquals(new DateTime('2018-10-10 00:00:00'), $orderedShipment->getDate());
        $this->assertEquals('http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..', $orderedShipment->getFileUrl());
        $this->assertEquals('http://pdf.balikobot.cz/cp/eNoz0jW0XDBcMAHtXDDJ', $orderedShipment->getLabelsUrl());
        $this->assertEquals('http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.', $orderedShipment->getHandoverUrl());
        $this->assertEquals(29, $orderedShipment->getOrderId());
    }
}
