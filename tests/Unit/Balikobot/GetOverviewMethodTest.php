<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetOverviewMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'packages' => [],
        ], [
            'https://apiv2.balikobot.cz/ppl/overview',
            [],
        ]);

        $service = new Balikobot($requester);

        $service->getOverview('ppl');

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'packages' => [
                0 => [
                    'carrier_id' => 'NP1504102246M',
                    'eid'        => '0001',
                    'package_id' => '42719',
                    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                ],
                1 => [
                    'carrier_id' => 'NP1504102247M',
                    'eid'        => '0001',
                    'package_id' => '42720',
                    'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
                ],
            ],
        ]);

        $orderedPackages = $service->getOverview('ppl');

        self::assertEquals(2, $orderedPackages->count());
        self::assertEquals(['42719', '42720'], $orderedPackages->getPackageIds());
        self::assertEquals('NP1504102247M', $orderedPackages[1]->getCarrierId());
        self::assertEquals('0001', $orderedPackages[0]->getBatchId());
    }
}
