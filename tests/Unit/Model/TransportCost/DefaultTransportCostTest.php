<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\TransportCost;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCost;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCostPart;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultTransportCostTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $parts = [
            new DefaultTransportCostPart(
                'Base price',
                800,
                'CZK',
            ),
            new DefaultTransportCostPart(
                'Part price',
                400,
                'CZK',
            ),
        ];
        $model = new DefaultTransportCost(
            '9636699909',
            Carrier::CP,
            1200,
            'CZK',
            $parts,
        );

        self::assertSame('9636699909', $model->getBatchId());
        self::assertSame(Carrier::CP, $model->getCarrier());
        self::assertSame(1200.0, $model->getTotalCost());
        self::assertSame('CZK', $model->getCurrencyCode());
        self::assertSame($parts, $model->getCostsBreakdown());
        self::assertSame('Base price', $model->getCostsBreakdown()[0]->getName());
        self::assertSame(800.0, $model->getCostsBreakdown()[0]->getCost());
        self::assertSame('CZK', $model->getCostsBreakdown()[0]->getCurrencyCode());
        self::assertSame([
            'batchId' => '9636699909',
            'carrier' => 'cp',
            'totalCost' => 1200.0,
            'currencyCode' => 'CZK',
            'costsBreakdown' => [
                [
                    'name' => 'Base price',
                    'cost' => 800.0,
                    'currencyCode' => 'CZK',
                ],
                [
                    'name' => 'Part price',
                    'cost' => 400.0,
                    'currencyCode' => 'CZK',
                ],
            ],
        ], $model->__toArray());
    }
}
