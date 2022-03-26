<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Model\Values\AdrUnit;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class AdrUnitTest extends AbstractTestCase
{
    public function testStaticConstructor(): void
    {
        $unit = AdrUnit::newInstanceFromData(
            'toptrans',
            [
                'id'                 => '299',
                'code'               => '432',
                'name'               => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                'class'              => '1',
                'packaging'          => 'Y',
                'tunnel_code'        => 'E',
                'transport_category' => '4',
            ]
        );

        self::assertEquals('toptrans', $unit->getShipper());
        self::assertEquals('299', $unit->getId());
        self::assertEquals('432', $unit->getCode());
        self::assertEquals('PŘEDMĚTY PYROTECHNICKÉ pro technické účely', $unit->getName());
        self::assertEquals('1', $unit->getClass());
        self::assertEquals('Y', $unit->getPackaging());
        self::assertEquals('E', $unit->getTunnelCode());
        self::assertEquals('4', $unit->getTransportCategory());
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $unit = AdrUnit::newInstanceFromData(
            'toptrans',
            [
                'id'                 => '299',
                'code'               => '432',
                'name'               => 'PŘEDMĚTY PYROTECHNICKÉ pro technické účely',
                'class'              => '1',
                'packaging'          => null,
                'tunnel_code'        => null,
                'transport_category' => '4',
            ]
        );

        self::assertEquals('toptrans', $unit->getShipper());
        self::assertEquals('299', $unit->getId());
        self::assertEquals('432', $unit->getCode());
        self::assertEquals('PŘEDMĚTY PYROTECHNICKÉ pro technické účely', $unit->getName());
        self::assertEquals('1', $unit->getClass());
        self::assertNull($unit->getPackaging());
        self::assertNull($unit->getTunnelCode());
        self::assertEquals('4', $unit->getTransportCategory());
    }
}
