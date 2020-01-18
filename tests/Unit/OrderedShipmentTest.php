<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use DateTime;
use Inspirum\Balikobot\Model\Values\OrderedShipment;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class OrderedShipmentTest extends AbstractTestCase
{
    public function testStaticConstructor()
    {
        $orderedShipment = OrderedShipment::newInstanceFromData(
            'cp',
            [1, 67],
            [
                'order_id'     => 1234,
                'handover_url' => '/handover',
                'labels_url'   => '/labels',
                'file_url'     => '/file',
            ],
            new DateTime('2018-10-10 14:00:00')
        );

        $this->assertEquals('cp', $orderedShipment->getShipper());
        $this->assertEquals(1234, $orderedShipment->getOrderId());
        $this->assertEquals('/handover', $orderedShipment->getHandoverUrl());
        $this->assertEquals('/labels', $orderedShipment->getLabelsUrl());
        $this->assertEquals('/file', $orderedShipment->getFileUrl());
        $this->assertEquals([1, 67], $orderedShipment->getPackageIds());
        $this->assertEquals(new DateTime('2018-10-10 14:00:00'), $orderedShipment->getDate());
    }

    public function testStaticConstructorWithMissingData()
    {
        $orderedShipment = OrderedShipment::newInstanceFromData(
            'cp',
            [1, 67],
            [
                'order_id'     => 1234,
                'handover_url' => '/handover',
                'labels_url'   => '/labels',
            ]
        );

        $this->assertEquals('cp', $orderedShipment->getShipper());
        $this->assertEquals(1234, $orderedShipment->getOrderId());
        $this->assertEquals('/handover', $orderedShipment->getHandoverUrl());
        $this->assertEquals('/labels', $orderedShipment->getLabelsUrl());
        $this->assertEquals(null, $orderedShipment->getFileUrl());
        $this->assertEquals([1, 67], $orderedShipment->getPackageIds());
        $this->assertEquals(null, $orderedShipment->getDate());
    }
}
