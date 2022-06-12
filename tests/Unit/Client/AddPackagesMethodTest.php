<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class AddPackagesMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->addPackages('cp', [['eid' => 1]]);
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->addPackages('cp', [['eid' => 1]]);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 400,
            'packages' => [
                0 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102246M',
                    'package_id'   => '42719',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'       => 200,
                ],
            ],
        ]);

        $client->addPackages('cp', [['eid' => 1]]);
    }

    public function testThrowsExceptionWhenNoReturnPackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'status' => 200,
                ],
            ],
        ]);

        $client->addPackages('cp', [['eid' => 1]]);
    }

    public function testThrowsExceptionWhenBadResponseData(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'package_id' => '42719',
                    'status'     => 200,
                ],
                1 => [
                    'status' => 200,
                ],
            ],
        ]);

        $client->addPackages('cp', [['eid' => 1], ['eid' => 2]]);
    }

    public function testThrowsExceptionWhenWrongNumberOfPackages(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102246M',
                    'package_id'   => '42719',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'       => '200',
                ],
                1 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102247M',
                    'package_id'   => '42720',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'       => '200',
                ],
            ],
        ]);

        $client->addPackages('cp', [['eid' => 1]]);
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'   => 200,
            'packages' => [
                0 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102246M',
                    'package_id'   => '42719',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'       => '200',
                ],
            ],
        ], [
            'https://apiv2.balikobot.cz/cp/add',
            [
                'packages' => [
                    [
                        'data' => [1, 2, 3],
                        'test' => false,
                    ],
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->addPackages('cp', [['data' => [1, 2, 3], 'test' => false]]);

        self::assertTrue(true);
    }

    public function testOnlyPackagesDataAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
            'status'     => 200,
            'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
            'packages'   => [
                0 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102246M',
                    'package_id'   => '42719',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'       => '200',
                ],
                1 => [
                    'eid'          => '0002',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102247M',
                    'package_id'   => '42720',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
                    'status'       => '200',
                ],
            ],
        ]);

        $packages = $client->addPackages('cp', [['eid' => '0001'], ['eid' => '0002']]);

        self::assertEquals(
            [
                0 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102246M',
                    'package_id'   => '42719',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'       => '200',
                ],
                1 => [
                    'eid'          => '0002',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102247M',
                    'package_id'   => '42720',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
                    'status'       => '200',
                ],
            ],
            $packages
        );
    }

    public function testLabelsUrl(): void
    {
        $client = $this->newMockedClient(200, [
            'status'     => 200,
            'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoC.',
            'packages'   => [
                0 => [
                    'eid'          => '0001',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102246M',
                    'package_id'   => '42719',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                    'status'       => '200',
                ],
                1 => [
                    'eid'          => '0002',
                    'order_number' => 1,
                    'carrier_id'   => 'NP1504102247M',
                    'package_id'   => '42720',
                    'label_url'    => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
                    'status'       => '200',
                ],
            ],
        ]);

        $labelsUrl = null;

        $client->addPackages('cp', [['eid' => '0001'], ['eid' => '0002']], $labelsUrl);

        self::assertEquals('https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoC.', $labelsUrl);
    }
}
