<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class OrderedPackageTest extends AbstractTestCase
{
    public function testStaticConstructor(): void
    {
        $orderedPackage = OrderedPackage::newInstanceFromData('cp', [
            'eid'             => '0001',
            'order_number'    => 1,
            'package_id'      => '1234',
            'carrier_id'      => '02IID',
            'track_url'       => '/track',
            'label_url'       => '/labels',
            'carrier_id_swap' => '23',
            'pieces'          => ['1', '2'],
        ]);

        self::assertEquals('cp', $orderedPackage->getShipper());
        self::assertEquals('0001', $orderedPackage->getBatchId());
        self::assertEquals('1234', $orderedPackage->getPackageId());
        self::assertEquals('02IID', $orderedPackage->getCarrierId());
        self::assertEquals('/track', $orderedPackage->getTrackUrl());
        self::assertEquals('/labels', $orderedPackage->getLabelUrl());
        self::assertEquals('23', $orderedPackage->getCarrierIdSwap());
        self::assertEquals(['1', '2'], $orderedPackage->getPieces());
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $orderedPackage = OrderedPackage::newInstanceFromData('cp', [
            'eid'          => '0001',
            'order_number' => 1,
            'package_id'   => '1234',
            'carrier_id'   => '02IID',
            'label_url'    => '/labels',
        ]);

        self::assertEquals('cp', $orderedPackage->getShipper());
        self::assertEquals('0001', $orderedPackage->getBatchId());
        self::assertEquals('1234', $orderedPackage->getPackageId());
        self::assertEquals('02IID', $orderedPackage->getCarrierId());
        self::assertEquals(null, $orderedPackage->getTrackUrl());
        self::assertEquals('/labels', $orderedPackage->getLabelUrl());
        self::assertEquals(null, $orderedPackage->getCarrierIdSwap());
        self::assertEquals([], $orderedPackage->getPieces());
    }

    public function testStaticConstructorWithIntegerIds(): void
    {
        $orderedPackage = OrderedPackage::newInstanceFromData('cp', [
            'eid'          => '0001',
            'order_number' => 1,
            'package_id'   => 1234,
            'carrier_id'   => 12,
            'label_url'    => '/labels',
        ]);

        self::assertEquals('cp', $orderedPackage->getShipper());
        self::assertEquals('0001', $orderedPackage->getBatchId());
        self::assertEquals('1234', $orderedPackage->getPackageId());
        self::assertEquals('12', $orderedPackage->getCarrierId());
        self::assertEquals(null, $orderedPackage->getTrackUrl());
        self::assertEquals('/labels', $orderedPackage->getLabelUrl());
        self::assertEquals(null, $orderedPackage->getCarrierIdSwap());
        self::assertEquals([], $orderedPackage->getPieces());
    }

    public function testStaticConstructorWithMissingCarrierId(): void
    {
        $orderedPackage = OrderedPackage::newInstanceFromData('cp', [
            'eid'          => '0001',
            'order_number' => 1,
            'package_id'   => '1234',
        ]);

        self::assertEquals('cp', $orderedPackage->getShipper());
        self::assertEquals('0001', $orderedPackage->getBatchId());
        self::assertEquals('1234', $orderedPackage->getPackageId());
        self::assertEquals('', $orderedPackage->getCarrierId());
        self::assertEquals(null, $orderedPackage->getTrackUrl());
        self::assertEquals(null, $orderedPackage->getLabelUrl());
        self::assertEquals(null, $orderedPackage->getCarrierIdSwap());
        self::assertEquals([], $orderedPackage->getPieces());
    }

    public function testStaticConstructorWithFinalTrackUrl(): void
    {
        $orderedPackage = OrderedPackage::newInstanceFromData('cp', [
            'eid'              => '0001',
            'order_number'     => 1,
            'package_id'       => '1234',
            'carrier_id_final' => '00605444103',
            'track_url_final'  => 'https://online.gls-slovakia.sk/tt_page.php',
        ]);

        self::assertEquals('cp', $orderedPackage->getShipper());
        self::assertEquals('0001', $orderedPackage->getBatchId());
        self::assertEquals('1234', $orderedPackage->getPackageId());
        self::assertEquals('', $orderedPackage->getCarrierId());
        self::assertEquals(null, $orderedPackage->getTrackUrl());
        self::assertEquals(null, $orderedPackage->getLabelUrl());
        self::assertEquals(null, $orderedPackage->getCarrierIdSwap());
        self::assertEquals('00605444103', $orderedPackage->getFinalCarrierId());
        self::assertEquals('https://online.gls-slovakia.sk/tt_page.php', $orderedPackage->getFinalTrackUrl());
        self::assertEquals([], $orderedPackage->getPieces());
    }
}
