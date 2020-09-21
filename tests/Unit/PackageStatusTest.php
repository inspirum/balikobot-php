<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use DateTime;
use Inspirum\Balikobot\Model\Values\PackageStatus;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class PackageStatusTest extends AbstractTestCase
{
    public function testStaticConstructor()
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

        $this->assertEquals(new DateTime('2018-11-07 14:15:01'), $status->getDate());
        $this->assertEquals(2.1, $status->getId());
        $this->assertEquals('Zásilka byla doručena příjemci.', $status->getName());
        $this->assertEquals('Doručení', $status->getDescription());
        $this->assertEquals('notification', $status->getType());
    }

    public function testStaticConstructorWithMissingData()
    {
        $status = PackageStatus::newInstanceFromData(
            [
                'name'      => 'Doručení',
                'status_id' => 2,
            ]
        );

        $this->assertEquals(null, $status->getDate());
        $this->assertEquals(2.0, $status->getId());
        $this->assertEquals(2, $status->getGroupId());
        $this->assertEquals('Doručení', $status->getName());
        $this->assertEquals('Doručení', $status->getDescription());
        $this->assertEquals('event', $status->getType());
    }

    public function testStaticConstructorForV3Response()
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

        $this->assertEquals(new DateTime('2018-11-07 14:15:01'), $status->getDate());
        $this->assertEquals(2.3, $status->getId());
        $this->assertEquals('Zásilka byla doručena příjemci.', $status->getName());
        $this->assertEquals('Doručení', $status->getDescription());
        $this->assertEquals('event', $status->getType());
    }
}
