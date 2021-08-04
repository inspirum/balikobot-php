<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetServicesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getServices('cp');
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getServices('cp');
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getServices('cp');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getServices('cp');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/services',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfServiceTypesMissing(): void
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $services = $client->getServices('cp');

        $this->assertEquals([], $services);
    }

    public function testOnlyUnitsDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
            'status'        => 200,
            'service_types' => [
                [
                    'service_type' => 'NP',
                    'name'         => 'NP - Balík Na poštu',
                ],
                [
                    'service_type' => 'RR',
                    'name'         => 'RR - Doporučená zásilka Ekonomická',
                ],
            ],
        ]);

        $services = $client->getServices('cp');

        $this->assertEquals(
            [
                'NP' => 'NP - Balík Na poštu',
                'RR' => 'RR - Doporučená zásilka Ekonomická',
            ],
            $services
        );
    }
}
