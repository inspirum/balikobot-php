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
                'date'      => '2018-11-07 14:15:01',
                'name'      => 'Doručení',
                'status_id' => 2,
            ]
        );
        
        $this->assertEquals(new DateTime('2018-11-07 14:15:01'), $status->getDate());
        $this->assertEquals(2, $status->getId());
        $this->assertEquals('Doručení', $status->getName());
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
        $this->assertEquals(2, $status->getId());
        $this->assertEquals('Doručení', $status->getName());
    }
}
