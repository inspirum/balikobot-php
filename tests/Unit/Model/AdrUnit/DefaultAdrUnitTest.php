<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\AdrUnit;

use Inspirum\Balikobot\Model\AdrUnit\DefaultAdrUnit;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultAdrUnitTest extends BaseTestCase
{
    public function testModel(): void
    {
        $carrier       = 'ppl';
        $model         = new DefaultAdrUnit(
            $carrier,
            '299',
            '432',
            'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
            '1',
            'A',
            'E',
            '4',
        );
        $expectedArray = [
            'id'                => '299',
            'code'              => '432',
            'name'              => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
            'class'             => '1',
            'packaging'         => 'A',
            'tunnelCode'        => 'E',
            'transportCategory' => '4',
        ];

        self::assertSame($carrier, $model->getCarrier());
        self::assertSame('299', $model->getId());
        self::assertSame('432', $model->getCode());
        self::assertSame('PŘEDMĚTY PYROTECHNICKÉ pro technické účely', $model->getName());
        self::assertSame('1', $model->getClass());
        self::assertSame('A', $model->getPackaging());
        self::assertSame('E', $model->getTunnelCode());
        self::assertSame('4', $model->getTransportCategory());
        self::assertSame($expectedArray, $model->__toArray());
    }
}
