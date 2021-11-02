<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetB2AServicesMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $service->getB2AServices('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/b2a/services',
                [],
            ]
        );

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'        => 200,
            'service_types' => [
                '1'  => 'PPL Parcel Business CZ',
                '11' => 'PPL Parcel Import SK',
            ],
        ]);

        $services = $service->getB2AServices('ppl');

        self::assertEquals(
            [
                '1'  => 'PPL Parcel Business CZ',
                '11' => 'PPL Parcel Import SK',
            ],
            $services
        );
    }
}
