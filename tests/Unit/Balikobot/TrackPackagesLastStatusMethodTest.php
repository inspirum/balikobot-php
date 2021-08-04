<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class TrackPackagesLastStatusMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'packages' => [
                0 => [
                    'carrier_id'  => '1234',
                    'status'      => 200,
                    'status_id'   => 1.1,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
            ],
        ]);

        $service = new Balikobot($requester);

        $package = new OrderedPackage('1', 'ppl', '0001', '1234');

        $service->trackPackageLastStatus($package);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/v2/ppl/trackstatus',
                [
                    'carrier_ids' => [
                        '1234',
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'packages' => [
                0 => [
                    'carrier_id'  => '1234',
                    'status'      => 200,
                    'status_id'   => 1.1,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
            ],
        ]);

        $package = new OrderedPackage('1', 'ppl', '0001', '1234');

        $status = $service->trackPackageLastStatus($package);

        $this->assertEquals(1.1, $status->getId());
        $this->assertEquals(null, $status->getDate());
        $this->assertEquals('Zásilka byla doručena příjemci.', $status->getName());
    }

    public function testMakeRequestWithMultiplePackages(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'packages' => [
                0 => [
                    'carrier_id'  => '1236',
                    'status'      => 200,
                    'status_id'   => 1.3,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
                1 => [
                    'carrier_id'  => '1234',
                    'status'      => 200,
                    'status_id'   => 1.1,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
            ],
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();
        $packages->add(new OrderedPackage('1', 'ppl', '0001', '1236'));
        $packages->add(new OrderedPackage('2', 'ppl', '0001', '1234'));

        $service->trackPackagesLastStatus($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/v2/ppl/trackstatus',
                [
                    'carrier_ids' => [
                        '1236',
                        '1234',
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseDataWithMultiplePackages(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'packages' => [
                0 => [
                    'carrier_id'  => '1236',
                    'status'      => 200,
                    'status_id'   => 1.1,
                    'status_text' => 'Zásilka byla doručena příjemci.',
                ],
                1 => [
                    'carrier_id'  => '1234',
                    'status'      => 200,
                    'status_id'   => 2.1,
                    'status_text' => 'Zásilka nebyla doručena příjemci.',
                ],
            ],
        ]);

        $packages = new OrderedPackageCollection();
        $packages->add(new OrderedPackage('1', 'ppl', '0001', '1236'));
        $packages->add(new OrderedPackage('2', 'ppl', '0001', '1234'));

        $statuses = $service->trackPackagesLastStatus($packages);

        $this->assertCount(2, $statuses);
        $this->assertEquals(1.1, $statuses[0]->getId());
        $this->assertEquals(null, $statuses[0]->getDate());
        $this->assertEquals('Zásilka byla doručena příjemci.', $statuses[0]->getName());
        $this->assertEquals(2.1, $statuses[1]->getId());
        $this->assertEquals(null, $statuses[1]->getDate());
        $this->assertEquals('Zásilka nebyla doručena příjemci.', $statuses[1]->getName());
    }
}
