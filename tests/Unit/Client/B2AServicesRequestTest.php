<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class B2AServicesRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getB2AServices('ppl');
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->getB2AServices('ppl');
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->getB2AServices('ppl');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getB2AServices('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/b2a/services',
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

        $services = $client->getB2AServices('ppl');

        $this->assertEquals([], $services);
    }

    public function testOnlyUnitsDataAreReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'        => 200,
            'service_types' => [
                '1'  => 'PPL Parcel Business CZ',
                '11' => 'PPL Parcel Import SK',
            ],
        ]);

        $client = new Client($requester);

        $services = $client->getB2AServices('ppl');

        $this->assertEquals(
            [
                '1'  => 'PPL Parcel Business CZ',
                '11' => 'PPL Parcel Import SK',
            ],
            $services
        );
    }
}
