<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetOverviewTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, []);
        
        $service = new Balikobot($requester);
        
        $service->getOverview('ppl');
        
        $requester->shouldHaveReceived(
            'request',
            ['https://api.balikobot.cz/ppl/overview', []]
        );
        
        $this->assertTrue(true);
    }
    
    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            0 => [
                'carrier_id' => 'NP1504102246M',
                'eshop_id'   => '0001',
                'package_id' => 42719,
                'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
            ],
            1 => [
                'carrier_id' => 'NP1504102247M',
                'eshop_id'   => '0001',
                'package_id' => 42720,
                'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
            ]
        ]);
        
        $service = new Balikobot($requester);
        
        $orderedPackages = $service->getOverview('ppl');
        
        $this->assertEquals(2, $orderedPackages->count());
        $this->assertEquals([42719, 42720], $orderedPackages->getPackageIds());
        $this->assertEquals('NP1504102247M', $orderedPackages[1]->getCarrierId());
        $this->assertEquals('0001', $orderedPackages[0]->getBatchId());
    }
}
