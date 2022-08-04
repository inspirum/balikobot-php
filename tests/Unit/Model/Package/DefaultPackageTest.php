<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Package;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\Package\DefaultPackage;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultPackageTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $model = new DefaultPackage(
            Carrier::CP,
            '1234',
            '0001',
            '02IID',
        );

        self::assertSame(Carrier::CP, $model->getCarrier());
        self::assertSame('1234', $model->getPackageId());
        self::assertSame('0001', $model->getBatchId());
        self::assertSame('02IID', $model->getCarrierId());
        self::assertSame([
            'carrier'      => 'cp',
            'carrierId'      => '02IID',
            'packageId'      => '1234',
            'batchId'        => '0001',
            'trackUrl'       => null,
            'labelUrl'       => null,
            'carrierIdSwap'  => null,
            'pieces'         => [],
            'finalCarrierId' => null,
            'finalTrackUrl'  => null,
        ], $model->__toArray());
    }

    public function testGetterWithFullData(): void
    {
        $model = new DefaultPackage(
            Carrier::CP,
            '1234',
            '0001',
            '02IID',
            '/track',
            '/labels',
            '23',
            ['1', '2'],
            '00605444103',
            '/final-track',
        );

        self::assertSame(Carrier::CP, $model->getCarrier());
        self::assertSame('/track', $model->getTrackUrl());
        self::assertSame('/labels', $model->getLabelUrl());
        self::assertSame('23', $model->getCarrierIdSwap());
        self::assertSame(['1', '2'], $model->getPieces());
        self::assertSame('00605444103', $model->getFinalCarrierId());
        self::assertSame('/final-track', $model->getFinalTrackUrl());
        self::assertSame([
            'carrier'      => 'cp',
            'carrierId'      => '02IID',
            'packageId'      => '1234',
            'batchId'        => '0001',
            'trackUrl'       => '/track',
            'labelUrl'       => '/labels',
            'carrierIdSwap'  => '23',
            'pieces'         =>  ['1', '2'],
            'finalCarrierId' => '00605444103',
            'finalTrackUrl'  => '/final-track',
        ], $model->__toArray());
    }
}
