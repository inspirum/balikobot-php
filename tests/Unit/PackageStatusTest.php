<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use DateTime;
use Inspirum\Balikobot\Model\Values\PackageStatus;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class PackageStatusTest extends AbstractTestCase
{
    public function testStaticConstructor(): void
    {
        $status = PackageStatus::newInstanceFromData(
            [
                'date'          => '2018-11-07 14:15:01',
                'name'          => 'Doručení',
                'name_internal' => 'Zásilka byla doručena příjemci.',
                'status_id'     => 2.1,
                'type'          => 'notification',
            ]
        );

        self::assertEquals(new DateTime('2018-11-07 14:15:01'), $status->getDate());
        self::assertEquals(2.1, $status->getId());
        self::assertEquals('Zásilka byla doručena příjemci.', $status->getName());
        self::assertEquals('Doručení', $status->getDescription());
        self::assertEquals('notification', $status->getType());
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $status = PackageStatus::newInstanceFromData(
            [
                'name'      => 'Doručení',
                'status_id' => 2,
            ]
        );

        self::assertEquals(null, $status->getDate());
        self::assertEquals(2.0, $status->getId());
        self::assertEquals(2, $status->getGroupId());
        self::assertEquals('Doručení', $status->getName());
        self::assertEquals('Doručení', $status->getDescription());
        self::assertEquals('event', $status->getType());
    }

    public function testStaticConstructorForV3Response(): void
    {
        $status = PackageStatus::newInstanceFromData(
            [
                'date'           => '2018-11-07 14:15:01',
                'name'           => 'Doručení',
                'name_balikobot' => 'Zásilka byla doručena příjemci.',
                'status_id'      => 2,
                'status_id_v2'   => 2.3,
                'type'           => 'event',
            ]
        );

        self::assertEquals(new DateTime('2018-11-07 14:15:01'), $status->getDate());
        self::assertEquals(2.3, $status->getId());
        self::assertEquals('Zásilka byla doručena příjemci.', $status->getName());
        self::assertEquals('Doručení', $status->getDescription());
        self::assertEquals('event', $status->getType());
    }
}
