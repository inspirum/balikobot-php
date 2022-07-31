<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\TransportCost;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCost;
use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCostCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;
use RuntimeException;

final class DefaultTransportCostCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $carrier       = Carrier::CP;
        $items         = [
            new DefaultTransportCost(
                '9636699909',
                $carrier,
                800.0,
                'CZK',
                [],
            ),
            new DefaultTransportCost(
                '9636699910',
                $carrier,
                1000.0,
                'CZK',
                [],
            ),
        ];
        $collection    = new DefaultTransportCostCollection($carrier, $items);
        $expectedArray = [
            [
                'batchId'        => '9636699909',
                'carrier'        => 'cp',
                'totalCost'      => 800.0,
                'currencyCode'   => 'CZK',
                'costsBreakdown' => [],
            ],
            [
                'batchId'        => '9636699910',
                'carrier'        => 'cp',
                'totalCost'      => 1000.0,
                'currencyCode'   => 'CZK',
                'costsBreakdown' => [],
            ],
        ];

        self::assertSame($carrier, $collection->getCarrier());
        self::assertSame($items, $collection->getCosts());
        self::assertSame(['9636699909', '9636699910'], $collection->getBatchIds());
        self::assertSame(1800.0, $collection->getTotalCost());
        self::assertSame('CZK', $collection->getCurrencyCode());
        self::assertSame($expectedArray, $collection->__toArray());
    }

    public function testEmptyCollection(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Collection is empty');

        $carrier    = Carrier::CP;
        $collection = new DefaultTransportCostCollection($carrier, []);

        $collection->getCurrencyCode();
    }

    public function testDifferenceCurrencyCode(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Package cost currency codes are not the same');

        $carrier    = Carrier::CP;
        $collection = new DefaultTransportCostCollection($carrier, [
            new DefaultTransportCost(
                '9636699909',
                $carrier,
                800.0,
                'CZK',
                [],
            ),
            new DefaultTransportCost(
                '9636699910',
                $carrier,
                1000.0,
                'EUR',
                [],
            ),
        ]);

        $collection->getTotalCost();
    }
}
