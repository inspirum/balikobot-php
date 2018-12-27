<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Requests;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class ServicesRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);
        
        $client = new Client($requester);
        
        $client->getServices('cp');
    }
    
    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(200, []);
        
        $client = new Client($requester);
        
        $client->getServices('cp');
    }
    
    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);
        
        $client = new Client($requester);
        
        $client->getServices('cp');
    }
    
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);
        
        $client = new Client($requester);
        
        $client->getServices('cp');
        
        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/services',
                [],
            ]
        );
        
        $this->assertTrue(true);
    }
    
    public function testEmptyArrayIsReturnedIfServiceTypesMissing()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);
        
        $client = new Client($requester);
        
        $services = $client->getServices('cp');
        
        $this->assertEquals([], $services);
    }
    
    public function testOnlyUnitsDataAreReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [
                'NP',
                'RR',
            ],
        ]);
        
        $client = new Client($requester);
        
        $services = $client->getServices('cp');
        
        $this->assertEquals(['NP', 'RR'], $services);
    }
}
