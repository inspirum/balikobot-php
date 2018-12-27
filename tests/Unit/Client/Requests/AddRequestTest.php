<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Request;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class AddRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);
        
        $client = new Client($requester);
        
        $client->addPackages('cp', []);
    }
    
    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(200, []);
        
        $client = new Client($requester);
        
        $client->addPackages('cp', []);
    }
    
    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
            0        => [
                'carrier_id' => 'NP1504102246M',
                'package_id' => 42719,
                'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                'status'     => '200',
            ],
        ]);
        
        $client = new Client($requester);
        
        $client->addPackages('cp', []);
    }
    
    public function testThrowsExceptionWhenNoReturnPackages()
    {
        $this->expectException(BadRequestException::class);
        
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'eid' => 200
            ]
        ]);
        
        $client = new Client($requester);
        
        $client->addPackages('cp', []);
    }
    
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'carrier_id' => 'NP1504102246M',
                'package_id' => 42719,
                'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                'status'     => '200',
            ],
        ]);
        
        $client = new Client($requester);
        
        $client->addPackages('cp', ['data' => [1, 2, 3], 'test' => false]);
        
        $requester->shouldHaveReceived(
            'request',
            ['https://api.balikobot.cz/cp/add', ['data' => [1, 2, 3], 'test' => false]]
        );
        
        $this->assertTrue(true);
    }
    
    public function testOnlyPackagesDataAreReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'     => 200,
            'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
            0            => [
                'carrier_id' => 'NP1504102246M',
                'package_id' => 42719,
                'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                'status'     => '200',
            ],
            1            => [
                'carrier_id' => 'NP1504102247M',
                'package_id' => 42720,
                'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
                'status'     => '200',
            ]
        ]);
        
        $client = new Client($requester);
        
        $packages = $client->addPackages('cp', []);
        
        $this->assertEquals(
            [
                0 => [
                    'carrier_id' => 'NP1504102246M',
                    'package_id' => 42719,
                    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'     => '200',
                ],
                1 => [
                    'carrier_id' => 'NP1504102247M',
                    'package_id' => 42720,
                    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
                    'status'     => '200',
                ]
            ],
            $packages
        );
    }
}
