<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\TransportCost;

use Inspirum\Balikobot\Model\TransportCost\DefaultTransportCostPart;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultTransportCostPartTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $model = new DefaultTransportCostPart(
            'Base price',
            800.0,
            'CZK',
        );

        self::assertSame('Base price', $model->getName());
        self::assertSame(800.0, $model->getCost());
        self::assertSame('CZK', $model->getCurrencyCode());
        self::assertSame([
            'name' => 'Base price',
            'cost' => 800.0,
            'currencyCode' => 'CZK',
        ], $model->__toArray());
    }
}
