<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class PackageCollectionTest extends AbstractTestCase
{
    public function testCreateEid()
    {
        $packages = new PackageCollection('cp');

        $this->assertNotEmpty($packages->getEid());
    }

    public function testCreateUniqueEid()
    {
        $packages1 = new PackageCollection('cp');
        $packages2 = new PackageCollection('cp');
        $packages3 = new PackageCollection('cp');

        $this->assertTrue($packages1->getEid() !== $packages2->getEid());
        $this->assertTrue($packages1->getEid() !== $packages3->getEid());
        $this->assertTrue($packages2->getEid() !== $packages3->getEid());
    }

    public function testAddedPackagesHasCollectionEid()
    {
        $packages = new PackageCollection('cp', '0001');

        $packages->add(new Package(['test' => 1]));
        $packages->add(new Package(['test' => 2]));

        /* @var \Inspirum\Balikobot\Model\Values\Package[] $packages */
        foreach ($packages as $package) {
            $this->assertEquals('0001', $package->getEID());
        }

        $this->assertEquals('cp', $packages->getShipper());
        $this->assertEquals(2, $packages->count());
    }

    public function testAddedPackagesAreClones()
    {
        $packages = new PackageCollection('cp', '0001');

        $package = new Package(['test' => 1]);

        $packages->add($package);

        $package->offsetSet('test', 2);

        $packages->add($package);

        $this->assertEquals(
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
}
