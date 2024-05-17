<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Package;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\Package\DefaultPackage;
use Inspirum\Balikobot\Model\Package\DefaultPackageCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultPackageCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier = Carrier::CP;
        $items = [
            new DefaultPackage(
                Carrier::CP,
                '1234',
                '0001',
                '02IID',
            ),
            new DefaultPackage(
                Carrier::CP,
                '1235',
                '0001',
                '02IIE',
            ),
        ];
        $labelsUrl = 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoC.';
        $collection = new DefaultPackageCollection($carrier, $items, $labelsUrl);
        $expectedArray = [
            [
                'carrier' => 'cp',
                'carrierId' => '02IID',
                'packageId' => '1234',
                'batchId' => '0001',
                'trackUrl' => null,
                'labelUrl' => null,
                'carrierIdSwap' => null,
                'pieces' => [],
                'finalCarrierId' => null,
                'finalTrackUrl' => null,
                'barcode' => null,
            ],
            [
                'carrier' => 'cp',
                'carrierId' => '02IIE',
                'packageId' => '1235',
                'batchId' => '0001',
                'trackUrl' => null,
                'labelUrl' => null,
                'carrierIdSwap' => null,
                'pieces' => [],
                'finalCarrierId' => null,
                'finalTrackUrl' => null,
                'barcode' => null,
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame($labelsUrl, $collection->getLabelsUrl());
        self::assertSame($items, $collection->getPackages());
        self::assertSame(['1234', '1235'], $collection->getPackageIds());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
