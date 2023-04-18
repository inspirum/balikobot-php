<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class TrackPackagesLastStatusMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->trackPackageLastStatus('cp', '1');
    }

    public function testRequestDoesNotHaveStatus(): void
    {
        $client = $this->newMockedClient(200, [
            'packages' => [
                0 => [
                    'carrier_id'  => '1',
                    'status'      => 200,
                    'status_id'   => 1.2,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
            ],
        ]);

        $status = $client->trackPackageLastStatus('cp', '1');

        self::assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->trackPackageLastStatus('cp', '1');
    }

    public function testThrowsExceptionOnBadStatusCodeForPackage(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'packages' => [
                0 => [
                    'status' => 404,
                ],
            ],
        ]);

        $client->trackPackageLastStatus('cp', '1');
    }

    public function testThrowsExceptionWhenNoReturn(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $client->trackPackageLastStatus('cp', '1');
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'carrier_id'  => '1',
                    'status'      => 200,
                    'status_id'   => 1.2,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackageLastStatus('cp', '1');

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/trackstatus',
                [
                    'carrier_ids' => [
                        '1',
                    ],
                ],
            ]
        );

        self::assertTrue(true);
    }

    public function testDataAreReturnedInV3Format(): void
    {
        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'carrier_id'  => '1',
                    'status'      => 200,
                    'status_id'   => 1.2,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
            ],
        ]);

        $status = $client->trackPackageLastStatus('cp', '1');

        self::assertEquals(
            [
                'name'          => 'Zásilka byla doručena příjemci.',
                'name_internal' => 'Zásilka byla doručena příjemci.',
                'type'          => 'event',
                'status_id'     => 1.2,
                'date'          => null,
            ],
            $status
        );
    }

    public function testThrowsExceptionOnErrorWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->trackPackagesLastStatus('cp', ['1', '3', '4']);
    }

    public function testRequestDoesNotHaveStatusWithMultiplePackages(): void
    {
        $client = $this->newMockedClient(200, [
            'packages' => [
                0 => [
                    'carrier_id'  => '1',
                    'status'      => 200,
                    'status_id'   => 1.2,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
                1 => [
                    'carrier_id'  => '5',
                    'status'      => 200,
                    'status_id'   => 2.1,
                    'status_text' => 'Zásilka nebyla doručena příjemci.',
                ],
                2 => [
                    'carrier_id'  => '6',
                    'status'      => 200,
                    'status_id'   => 1.2,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
            ],
        ]);

        $status = $client->trackPackagesLastStatus('cp', ['1', '5', '6']);

        self::assertNotEmpty($status);
    }

    public function testThrowsExceptionOnBadStatusCodeWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->trackPackagesLastStatus('cp', ['1', '4']);
    }

    public function testThrowsExceptionOnBadStatusCodeForPackageWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'packages' => [
                0 => [
                    'carrier_id'  => '1',
                    'status'      => 200,
                    'status_id'   => 2.2,
                    'status_text' => 'Zásilka nebyla doručena příjemci.',
                ],
                1 => [
                    'status' => 404,
                ],
            ],
        ]);

        $client->trackPackagesLastStatus('cp', ['1', '4']);
    }

    public function testThrowsExceptionWhenNoReturnWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 200,
        ]);

        $client->trackPackagesLastStatus('cp', ['1', '2']);
    }

    public function testThrowsExceptionWhenNotAllDataReturnWithMultiplePackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'carrier_id'  => '1',
                    'status'      => 200,
                    'status_id'   => 1.2,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
            ],
        ]);

        $client->trackPackagesLastStatus('cp', ['1', '2']);
    }

    public function testMakeRequestWithMultiplePackages(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'carrier_id'  => '1',
                    'status'      => 200,
                    'status_id'   => 1.2,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
                1 => [
                    'carrier_id'  => '6',
                    'status'      => 200,
                    'status_id'   => -1,
                    'status_text' => 'Obdrženy údaje k zásilce.',
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->trackPackagesLastStatus('cp', ['1', '6']);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/cp/trackstatus',
                [
                    'carrier_ids' => [
                        '1',
                        '6',
                    ],
                ],
            ]
        );

        self::assertTrue(true);
    }

    public function testDataAreReturnedInV2FormatWithMultiplePackages(): void
    {
        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'carrier_id'  => '1',
                    'status'      => 200,
                    'status_id'   => 1.2,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
                1 => [
                    'carrier_id'  => '6',
                    'status'      => 200,
                    'status_id'   => 5,
                    'status_text' => 'Zásilka nebyla doručena příjemci.',
                ],
                2 => [
                    'carrier_id'  => '5',
                    'status'      => 200,
                    'status_id'   => 3.2,
                    'status_text' => 'Storno ze strany příjemce.',
                ],
            ],
        ]);

        $status = $client->trackPackagesLastStatus('cp', ['1', '6', '5']);

        self::assertEquals(
            [
                0 => [
                    'name'          => 'Zásilka byla doručena příjemci.',
                    'name_internal' => 'Zásilka byla doručena příjemci.',
                    'type'          => 'event',
                    'status_id'     => 1.2,
                    'date'          => null,
                ],
                1 => [
                    'name'          => 'Zásilka nebyla doručena příjemci.',
                    'name_internal' => 'Zásilka nebyla doručena příjemci.',
                    'type'          => 'event',
                    'status_id'     => 5.0,
                    'date'          => null,
                ],
                2 => [
                    'name'          => 'Storno ze strany příjemce.',
                    'name_internal' => 'Storno ze strany příjemce.',
                    'type'          => 'event',
                    'status_id'     => 3.2,
                    'date'          => null,
                ],
            ],
            $status
        );
    }
}
