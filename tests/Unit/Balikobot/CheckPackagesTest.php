<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Services\Balikobot;

class CheckPackagesTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
        ]);

        $service = new Balikobot($requester);

        $packages = new PackageCollection('ppl');

        $packages->add(new Package(['vs' => '0001', 'eid' => '0001', 'rec_name' => 'Name']));
        $packages->add(new Package(['vs' => '0002', 'eid' => '0001', 'price' => 2000]));

        $service->checkPackages($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/check',
                [
                    0 => [
                        'eid'      => '0001',
                        'vs'       => '0001',
                        'rec_name' => 'Name',
                    ],
                    1 => [
                        'eid'   => '0001',
                        'vs'    => '0002',
                        'price' => 2000,
                    ],
                ],
            ]
        );

        $this->assertTrue(true);
    }
}
