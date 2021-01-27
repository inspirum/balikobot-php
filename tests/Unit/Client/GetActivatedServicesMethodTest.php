<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetActivatedServicesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getActivatedServices('cp');
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'active_parcel' => true,
            'active_cargo'  => false,
            'service_types' => [
                'DR' => 'DR - Balík Do ruky',
                'RR' => 'RR - Doporučená zásilka',
            ],
        ]);

        $client->getActivatedServices('cp');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'active_parcel' => true,
            'active_cargo'  => false,
            'service_types' => [
                'DR' => 'DR - Balík Do ruky',
                'RR' => 'RR - Doporučená zásilka',
            ],
        ]);

        $client = new Client($requester);

        $client->getActivatedServices('cp');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/activatedservices',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testOnlyPackagesDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
            'status'        => 200,
            'active_parcel' => true,
            'active_cargo'  => false,
            'service_types' => [
                'DR' => 'DR - Balík Do ruky',
                'RR' => 'RR - Doporučená zásilka',
            ],
        ]);

        $packages = $client->getActivatedServices('cp');

        $this->assertEquals(
            [
                'active_parcel' => true,
                'active_cargo'  => false,
                'service_types' => [
                    'DR' => 'DR - Balík Do ruky',
                    'RR' => 'RR - Doporučená zásilka',
                ],
            ],
            $packages
        );
    }
}
