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

        $this->assertEquals('cp', $orderedPackage->getShipper());
        $this->assertEquals('0001', $orderedPackage->getBatchId());
        $this->assertEquals('1234', $orderedPackage->getPackageId());
        $this->assertEquals('02IID', $orderedPackage->getCarrierId());
        $this->assertEquals('/track', $orderedPackage->getTrackUrl());
        $this->assertEquals('/labels', $orderedPackage->getLabelUrl());
        $this->assertEquals('23', $orderedPackage->getCarrierIdSwap());
        $this->assertEquals(['1', '2'], $orderedPackage->getPieces());
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

        $this->assertEquals('cp', $orderedPackage->getShipper());
        $this->assertEquals('0001', $orderedPackage->getBatchId());
        $this->assertEquals('1234', $orderedPackage->getPackageId());
        $this->assertEquals('02IID', $orderedPackage->getCarrierId());
        $this->assertEquals(null, $orderedPackage->getTrackUrl());
        $this->assertEquals('/labels', $orderedPackage->getLabelUrl());
        $this->assertEquals(null, $orderedPackage->getCarrierIdSwap());
        $this->assertEquals([], $orderedPackage->getPieces());
    }

    public function testStaticConstructorWithMissingCarrierId(): void
    {
        $orderedPackage = OrderedPackage::newInstanceFromData('cp', [
            'eid'          => '0001',
            'order_number' => 1,
            'package_id'   => '1234',
        ]);

        $this->assertEquals('cp', $orderedPackage->getShipper());
        $this->assertEquals('0001', $orderedPackage->getBatchId());
        $this->assertEquals('1234', $orderedPackage->getPackageId());
        $this->assertEquals('', $orderedPackage->getCarrierId());
        $this->assertEquals(null, $orderedPackage->getTrackUrl());
        $this->assertEquals(null, $orderedPackage->getLabelUrl());
        $this->assertEquals(null, $orderedPackage->getCarrierIdSwap());
        $this->assertEquals([], $orderedPackage->getPieces());
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

        $this->assertEquals('cp', $orderedPackage->getShipper());
        $this->assertEquals('0001', $orderedPackage->getBatchId());
        $this->assertEquals('1234', $orderedPackage->getPackageId());
        $this->assertEquals('', $orderedPackage->getCarrierId());
        $this->assertEquals(null, $orderedPackage->getTrackUrl());
        $this->assertEquals(null, $orderedPackage->getLabelUrl());
        $this->assertEquals(null, $orderedPackage->getCarrierIdSwap());
        $this->assertEquals('00605444103', $orderedPackage->getFinalCarrierId());
        $this->assertEquals('https://online.gls-slovakia.sk/tt_page.php', $orderedPackage->getFinalTrackUrl());
        $this->assertEquals([], $orderedPackage->getPieces());
    }
}
