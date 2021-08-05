<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Model\Values\OrderedShipment;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class OrderedShipmentTest extends AbstractTestCase
{
    public function testStaticConstructor(): void
    {
        $orderedShipment = OrderedShipment::newInstanceFromData(
            'cp',
            ['1', '67'],
            [
                'order_id'     => '1234',
                'handover_url' => '/handover',
                'labels_url'   => '/labels',
                'file_url'     => '/file',
            ]
        );

        $this->assertEquals('cp', $orderedShipment->getShipper());
        $this->assertEquals('1234', $orderedShipment->getOrderId());
        $this->assertEquals('/handover', $orderedShipment->getHandoverUrl());
        $this->assertEquals('/labels', $orderedShipment->getLabelsUrl());
        $this->assertEquals('/file', $orderedShipment->getFileUrl());
        $this->assertEquals(['1', '67'], $orderedShipment->getPackageIds());
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $orderedShipment = OrderedShipment::newInstanceFromData(
            'cp',
            ['1', '67'],
            [
                'order_id'     => '1234',
                'handover_url' => '/handover',
                'labels_url'   => '/labels',
            ]
        );

        $this->assertEquals('cp', $orderedShipment->getShipper());
        $this->assertEquals('1234', $orderedShipment->getOrderId());
        $this->assertEquals('/handover', $orderedShipment->getHandoverUrl());
        $this->assertEquals('/labels', $orderedShipment->getLabelsUrl());
        $this->assertEquals(null, $orderedShipment->getFileUrl());
        $this->assertEquals(['1', '67'], $orderedShipment->getPackageIds());
    }
}
