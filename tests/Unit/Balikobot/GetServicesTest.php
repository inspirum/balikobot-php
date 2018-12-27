<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetServicesTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);
        
        $service = new Balikobot($requester);
        
        $service->getServices('ppl');
        
        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/services',
                [],
            ]
        );
        
        $this->assertTrue(true);
    }
    
    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [
                'NP',
                'RR',
            ],
        ]);
        
        $service = new Balikobot($requester);
        
        $services = $service->getServices('ppl');
        
        $this->assertEquals(['NP', 'RR'], $services);
    }
}
