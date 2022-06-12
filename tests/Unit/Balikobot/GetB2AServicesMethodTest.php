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
        ], [
            'https://apiv2.balikobot.cz/ppl/b2a/services',
            [],
        ]);

        $service = new Balikobot($requester);

        $service->getB2AServices('ppl');

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'        => 200,
            'service_types' => [
                [
                    'service_type' => '1',
                    'name'         => 'PPL Parcel Business CZ',
                ],
                [
                    'service_type' => '11',
                    'name'         => 'PPL Parcel Import SK',
                ],
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
