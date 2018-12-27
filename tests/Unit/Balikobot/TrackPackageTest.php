<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use DateTime;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class TrackPackageTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                [
                    'date'      => '2018-11-07 14:15:01',
                    'name'      => 'Přijetí',
                    'status_id' => 2,
                ],
            ],
        ]);
        
        $service = new Balikobot($requester);
        
        $package = new OrderedPackage(1, 'ppl', '0001', '1234');
        
        $service->trackPackage($package);
        
        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/v2/ppl/track',
                [
                    0 => [
                        'id' => '1234',
                    ],
                ],
            ]
        );
        
        $this->assertTrue(true);
    }
    
    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                [
                    'date'      => '2018-11-07 14:15:01',
                    'name'      => 'Přijetí',
                    'status_id' => 2,
                ],
                [
                    'date'      => '2018-11-08 18:00:00',
                    'name'      => 'Doručení',
                    'status_id' => 1,
                ],
                [
                    'date'      => '2018-11-09 11:19:51',
                    'name'      => 'Dodání',
                    'status_id' => -1,
                ],
            ],
        ]);
        
        $service = new Balikobot($requester);
        
        $package = new OrderedPackage(1, 'ppl', '0001', '1234');
        
        $statuses = $service->trackPackage($package);
        
        $this->assertEquals(3, count($statuses));
        $this->assertEquals(2, $statuses[0]->getId());
        $this->assertEquals(new DateTime('2018-11-08 18:00:00'), $statuses[1]->getDate());
        $this->assertEquals('Dodání', $statuses[2]->getName());
        $this->assertEquals(1, $statuses[1]->getId());
    }
}
