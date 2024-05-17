<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\OrderedShipment;

use Inspirum\Balikobot\Model\OrderedShipment\DefaultOrderedShipment;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultOrderedShipmentTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $model = new DefaultOrderedShipment(
            '1234',
            'cp',
            ['1', '67'],
            '/handover',
            '/labels',
            '/file',
        );

        self::assertSame('cp', $model->getCarrier());
        self::assertSame('1234', $model->getOrderId());
        self::assertSame('/handover', $model->getHandoverUrl());
        self::assertSame('/labels', $model->getLabelsUrl());
        self::assertSame('/file', $model->getFileUrl());
        self::assertSame(['1', '67'], $model->getPackageIds());
        self::assertSame([
            'carrier' => 'cp',
            'orderId' => '1234',
            'packageIds' => [
                '1',
                '67',
            ],
            'handoverUrl' => '/handover',
            'labelsUrl' => '/labels',
            'fileUrl' => '/file',
        ], $model->__toArray());
    }
}
