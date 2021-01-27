<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetOverviewMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'packages' => [],
        ]);

        $service = new Balikobot($requester);

        $service->getOverview('ppl');

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/ppl/overview', []]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
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

        $this->assertEquals(2, $orderedPackages->count());
        $this->assertEquals(['42719', '42720'], $orderedPackages->getPackageIds());
        $this->assertEquals('NP1504102247M', $orderedPackages[1]->getCarrierId());
        $this->assertEquals('0001', $orderedPackages[0]->getBatchId());
    }
}
