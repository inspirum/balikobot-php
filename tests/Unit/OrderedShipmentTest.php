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

        self::assertEquals('cp', $orderedShipment->getShipper());
        self::assertEquals('1234', $orderedShipment->getOrderId());
        self::assertEquals('/handover', $orderedShipment->getHandoverUrl());
        self::assertEquals('/labels', $orderedShipment->getLabelsUrl());
        self::assertEquals('/file', $orderedShipment->getFileUrl());
        self::assertEquals(['1', '67'], $orderedShipment->getPackageIds());
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

        self::assertEquals('cp', $orderedShipment->getShipper());
        self::assertEquals('1234', $orderedShipment->getOrderId());
        self::assertEquals('/handover', $orderedShipment->getHandoverUrl());
        self::assertEquals('/labels', $orderedShipment->getLabelsUrl());
        self::assertEquals(null, $orderedShipment->getFileUrl());
        self::assertEquals(['1', '67'], $orderedShipment->getPackageIds());
    }
}
