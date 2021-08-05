<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Tests\AbstractTestCase;
use InvalidArgumentException;
use RuntimeException;

class OrderedPackageCollectionTest extends AbstractTestCase
{
    public function testGetters(): void
    {
        $packages = new OrderedPackageCollection('cp');

        $packages->add(new OrderedPackage('1', 'cp', '0001', '1234'));
        $packages->add(new OrderedPackage('2', 'cp', '0001', '5678'));

        $this->assertEquals('cp', $packages->getShipper());
        $this->assertEquals(['1', '2'], $packages->getPackageIds());
        $this->assertEquals(['1234', '5678'], $packages->getCarrierIds());
        $this->assertEquals(2, $packages->count());
    }

    public function testThrowsErrorOnMissingShipper(): void
    {
        $this->expectException(RuntimeException::class);

        $packages = new OrderedPackageCollection();

        $packages->getShipper();
    }

    public function testCollectionShipperFromFirstPackage(): void
    {
        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage('1', 'cp', '0001', '1234'));

        $this->assertEquals('cp', $packages->getShipper());
    }

    public function testDiffShipperThrowsError(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Package is from different shipper ("ppl" instead of "cp")');

        $packages = new OrderedPackageCollection('cp');

        $packages->add(new OrderedPackage('1', 'cp', '0001', '1234'));
        $packages->add(new OrderedPackage('2', 'ppl', '0001', '5678'));
    }

    public function testDiffShipperThrowsErrorWithOffsetSetMethod(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Package is from different shipper ("ppl" instead of "cp")');

        $packages = new OrderedPackageCollection('cp');

        $packages->offsetSet(1, new OrderedPackage('1', 'cp', '0001', '1234'));
        $packages->offsetSet(2, new OrderedPackage('2', 'ppl', '0001', '5678'));
    }

    public function testSupportArrayAccess(): void
    {
        $packages = new OrderedPackageCollection('cp');

        $packages->offsetSet(1, new OrderedPackage('1', 'cp', '0001', '1234'));
        $packages->offsetSet(4, new OrderedPackage('2', 'cp', '0001', '5678'));

        $this->assertEquals(2, $packages->offsetGet(4)->getPackageId());
        $this->assertEquals(2, $packages->count());
        $this->assertTrue($packages->offsetExists(1));

        $packages->offsetUnset(1);

        $this->assertFalse($packages->offsetExists(1));
    }

    public function testSupportIteratorAggregate(): void
    {
        $packages = new OrderedPackageCollection('cp');

        $packages->add(new OrderedPackage('6', 'cp', '0001', '1234'));
        $packages->add(new OrderedPackage('2', 'cp', '0001', '5678'));

        $iterator = $packages->getIterator();

        $this->assertEquals(2, $iterator->count());
        $this->assertEquals('6', $iterator->current()->getPackageId());
    }

    public function testLabelsUrl(): void
    {
        $packages = new OrderedPackageCollection();

        $this->assertNull($packages->getLabelsUrl());

        $packages->setLabelsUrl('https://pdf.balikobot.cz/ups/eNorMTIwt9A1NbYwMwdcMBAZAoC.');

        $this->assertEquals('https://pdf.balikobot.cz/ups/eNorMTIwt9A1NbYwMwdcMBAZAoC.', $packages->getLabelsUrl());
    }
}
