<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\PackageData;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageData;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageDataCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultPackageDataCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = Carrier::CP;
        $items         = [
            new DefaultPackageData(
                [
                    'eid' => '0123456',
                ]
            ),
            new DefaultPackageData(
                [
                    'eid' => '0123457',
                ]
            ),
        ];
        $collection    = new DefaultPackageDataCollection($carrier, $items);
        $expectedArray = [
            [
                'eid' => '0123456',
            ],
            [
                'eid' => '0123457',
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertEquals($items, $collection->getPackages());
        self::assertSame($expectedArray, $collection->__toArray());
    }

    public function testAddEid(): void
    {
        $packages = new DefaultPackageDataCollection(Carrier::CP);
        $package  = new DefaultPackageData(['test' => 1]);

        self::assertNull($package->getEID());

        $packages->offsetAdd($package);

        self::assertNotNull($packages->offsetGet(0)->getEID());
        self::assertNull($package->getEID());
    }

    public function testSetEid(): void
    {
        $packages = new DefaultPackageDataCollection(Carrier::CP);
        $package  = new DefaultPackageData(['test' => 1]);

        self::assertNull($package->getEID());

        $packages->offsetSet(1, $package);

        self::assertNotNull($packages->offsetGet(1)->getEID());
        self::assertNull($package->getEID());
    }

    public function testUniqueEid(): void
    {
        $packages1 = new DefaultPackageDataCollection(Carrier::CP);
        $packages2 = new DefaultPackageDataCollection(Carrier::CP);
        $packages3 = new DefaultPackageDataCollection(Carrier::CP);

        $package = new DefaultPackageData(['test' => 1]);

        $packages1->add($package);
        $packages2->add($package);
        $packages3->add($package);

        self::assertNotEquals($packages1->offsetGet(0)->getEid(), $packages2->offsetGet(0)->getEid());
        self::assertNotEquals($packages1->offsetGet(0)->getEid(), $packages3->offsetGet(0)->getEid());
        self::assertNotEquals($packages2->offsetGet(0)->getEid(), $packages3->offsetGet(0)->getEid());
    }

    public function testUniqueEidInCollection(): void
    {
        $packages = new DefaultPackageDataCollection(Carrier::CP);

        $packages->add(new DefaultPackageData(['test' => 1]));
        $packages->add(new DefaultPackageData(['test' => 2]));

        self::assertNotNull($packages->offsetGet(0)->getEID());
        self::assertNotNull($packages->offsetGet(1)->getEID());
        self::assertNotEquals($packages->offsetGet(0)->getEID(), $packages->offsetGet(1)->getEID());
    }

    public function testClonePackages(): void
    {
        $packages = new DefaultPackageDataCollection('cp');

        $package = new DefaultPackageData(['test' => 1, 'eid' => '0001']);

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
            $packages->__toArray()
        );
    }
}
