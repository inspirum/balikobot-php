<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetAddServiceOptionsMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'services' => [],
        ]);

        $service = new Balikobot($requester);

        $service->getAddServiceOptions('ppl');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/addserviceoptions',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithService(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'services' => [],
        ]);

        $service = new Balikobot($requester);

        $service->getAddServiceOptions('cp', 'CE');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/addserviceoptions/CE',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'       => 200,
            'service_type' => 'CE',
            'services'     => [
                [
                    'name' => 'Neskladně',
                    'code' => '10',
                ],
                [
                    'name' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                    'code' => '44',
                ],
            ],
        ]);

        $options = $service->getAddServiceOptions('cp', 'CE');

        $this->assertEquals(
            [
                '10' => 'Neskladně',
                '44' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
            ],
            $options
        );
    }

    public function testResponseDataWithoutServiceType(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'        => 200,
            'service_types' => [
                [
                    'service_type'      => 'CE',
                    'service_type_name' => 'CE - Obchodní balík do zahraničí',
                    'services'          => [
                        [
                            'name' => 'Neskladně',
                            'code' => '10',
                        ],
                        [
                            'name' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                            'code' => '44',
                        ],
                    ],
                ],
                [
                    'service_type'      => 'CV',
                    'service_type_name' => '',
                    'services'          => [
                        [
                            'name' => 'Dodejka',
                            'code' => '3',
                        ],
                        [
                            'name' => 'Dobírka Pk A/MZ dobírka',
                            'code' => '4',
                        ],
                    ],
                ],
            ],
        ]);

        $options = $service->getAddServiceOptions('cp');

        $this->assertEquals(
            [
                'CE' => [
                    '10' => 'Neskladně',
                    '44' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                ],
                'CV' => [
                    '3' => 'Dodejka',
                    '4' => 'Dobírka Pk A/MZ dobírka',
                ],
            ],
            $options
        );
    }
}
