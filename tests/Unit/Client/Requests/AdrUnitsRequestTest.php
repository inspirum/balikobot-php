<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Requests;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class AdrUnitsRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);
        
        $client = new Client($requester);
        
        $client->getAdrUnits('cp');
    }
    
    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(200, []);
        
        $client = new Client($requester);
        
        $client->getAdrUnits('cp');
    }
    
    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);
        
        $client = new Client($requester);
        
        $client->getAdrUnits('cp');
    }
    
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'units'  => [],
        ]);
        
        $client = new Client($requester);
        
        $client->getAdrUnits('cp');
        
        $requester->shouldHaveReceived(
            'request',
            ['https://api.balikobot.cz/cp/adrunits', []]
        );
        
        $this->assertTrue(true);
    }
    
    public function testEmptyArrayIsReturnedIfUnitsMissing()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'units'  => null,
        ]);
        
        $client = new Client($requester);
        
        $units = $client->getAdrUnits('cp');
        
        $this->assertEquals([], $units);
    }
    
    public function testOnlyUnitsDataAreReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'units'  => [
                [
                    'code' => 1,
                    'name' => "KM",
                    'attr' => 4
                ],
                [
                    'code' => 876,
                    'name' => "M",
                ]
            ],
        ]);
        
        $client = new Client($requester);
        
        $units = $client->getAdrUnits('cp');
        
        $this->assertEquals(
            [
                1   => "KM",
                876 => "M",
            ],
            $units
        );
    }
}
