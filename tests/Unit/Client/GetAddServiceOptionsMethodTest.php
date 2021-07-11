<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetAddServiceOptionsMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getAddServiceOptions('cp');
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getAddServiceOptions('cp');
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getAddServiceOptions('cp');
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getAddServiceOptions('cp');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/addserviceoptions',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithService()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getAddServiceOptions('cp', 'DR');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/cp/addserviceoptions/DR',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testEmptyArrayIsReturnedIfServiceTypesMissing()
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $services = $client->getAddServiceOptions('cp');

        $this->assertEquals([], $services);
    }

    public function testOnlyServicesDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
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

        $options = $client->getAddServiceOptions('cp', 'CE');

        $this->assertEquals(
            [
                '10' => 'Neskladně',
                '44' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
            ],
            $options
        );
    }

    public function testFullDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
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

        $options = $client->getAddServiceOptions('cp', 'CE', true);

        $this->assertEquals(
            [
                '10' => [
                    'code' => '10',
                    'name' => 'Neskladně',
                ],
                '44' => [
                    'code' => '44',
                    'name' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                ],
            ],
            $options
        );
    }

    public function testAllServicesDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
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

        $options = $client->getAddServiceOptions('cp');

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

    public function testAllFullDataAreReturned()
    {
        $client = $this->newMockedClient(200, [
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

        $options = $client->getAddServiceOptions('cp', null, true);

        $this->assertEquals(
            [
                'CE' => [
                    '10' => [
                        'code' => '10',
                        'name' => 'Neskladně',
                    ],
                    '44' => [
                        'code' => '44',
                        'name' => 'Zboží s VDD (pouze pro zásilky do ciziny s celní zónou)',
                    ],
                ],
                'CV' => [
                    '3' => [
                        'code' => '3',
                        'name' => 'Dodejka',
                    ],
                    '4' => [
                        'code' => '4',
                        'name' => 'Dobírka Pk A/MZ dobírka',
                    ],
                ],
            ],
            $options
        );
    }
}
