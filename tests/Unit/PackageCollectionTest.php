<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class PackageCollectionTest extends AbstractTestCase
{
    public function testCreateEid(): void
    {
        $packages = new PackageCollection('cp');

        $packages->add(new Package(['test' => 1]));

        self::assertNotEmpty($packages->offsetGet(0)->getEid());
    }

    public function testCreateUniqueEid(): void
    {
        $packages1 = new PackageCollection('cp');
        $packages2 = new PackageCollection('cp');
        $packages3 = new PackageCollection('cp');

        $package = new Package(['test' => 1]);

        $packages1->add($package);
        $packages2->add($package);
        $packages3->add($package);

        self::assertTrue($packages1->offsetGet(0)->getEid() !== $packages2->offsetGet(0)->getEid());
        self::assertTrue($packages1->offsetGet(0)->getEid() !== $packages3->offsetGet(0)->getEid());
        self::assertTrue($packages2->offsetGet(0)->getEid() !== $packages3->offsetGet(0)->getEid());
    }

    public function testAddedPackagesHasUniqueEid(): void
    {
        $packages = new PackageCollection('cp');

        $packages->add(new Package(['test' => 1]));
        $packages->add(new Package(['test' => 2]));

        self::assertNotEmpty($packages->offsetGet(0)->getEID());
        self::assertNotEmpty($packages->offsetGet(1)->getEID());
        self::assertTrue($packages->offsetGet(0)->getEID() !== $packages->offsetGet(1)->getEID());

        self::assertEquals('cp', $packages->getShipper());
        self::assertEquals(2, $packages->count());
    }

    public function testAddedPackagesAreClones(): void
    {
        $packages = new PackageCollection('cp');

        $package = new Package(['test' => 1, 'eid' => '0001']);

        $packages->add($package);

        $package->offsetSet('test', 2);

        $packages->add($package);

        self::assertEquals(
            [
                0 => [
                    'eid'  => '0001',
                    'test' => 1,
                ],
                1 => [
                    'eid'  => '0001',
                    'test' => 2,
                ],
            ],
            $packages->toArray()
        );
    }

    public function testSupportCustomEIDForPackage(): void
    {
        $packages = new PackageCollection('cp');

        $packages->add(new Package(['test' => 1, 'eid' => '0002']));
        $packages->add(new Package(['test' => 2, 'eid' => '0001']));

        self::assertEquals(
            [
                0 => [
                    'eid'  => '0002',
                    'test' => 1,
                ],
                1 => [
                    'eid'  => '0001',
                    'test' => 2,
                ],
            ],
            $packages->toArray()
        );
    }

    public function testSupportArrayAccess(): void
    {
        $packages = new PackageCollection('cp');

        $packages->add(new Package(['test' => 1, 'eid' => '0001']));
        $packages->add(new Package(['test' => 2, 'eid' => '0002']));

        self::assertEquals('0002', $packages->offsetGet(1)->getEID());
        self::assertEquals(2, $packages->count());
        self::assertTrue($packages->offsetExists(1));

        $packages->offsetUnset(1);

        self::assertFalse($packages->offsetExists(1));

        $packages->offsetSet(2, new Package(['test' => 3, 'eid' => '0003']));
        self::assertFalse($packages->offsetExists(1));
        self::assertTrue($packages->offsetExists(2));
    }

    public function testSupportIteratorAggregate(): void
    {
        $packages = new PackageCollection('cp');

        $packages->add(new Package(['test' => 1, 'eid' => '0001']));
        $packages->add(new Package(['test' => 2, 'eid' => '0002']));

        $iterator = $packages->getIterator();

        self::assertEquals(2, $iterator->count());
        self::assertEquals('0001', $iterator->current()->getEID());
    }
}
