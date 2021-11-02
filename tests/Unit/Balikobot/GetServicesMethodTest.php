<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetServicesMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $service->getServices('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/services',
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

        $services = $service->getServices('ppl');

        self::assertEquals(
            [
                'NP' => 'NP - Balík Na poštu',
                'RR' => 'RR - Doporučená zásilka Ekonomická',
            ],
            $services
        );
    }
}
