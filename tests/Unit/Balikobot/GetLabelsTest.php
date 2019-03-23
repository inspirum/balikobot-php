<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class GetLabelsTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'     => 200,
            'labels_url' => "http://pdf.balikobot.cz/dpd/eNorMdY1NFwwXDAELgE2",
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1234'));
        $packages->add(new OrderedPackage(7, 'ppl', '0001', '5678'));

        $service->getLabels($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/labels',
                [
                    'package_ids' => [1, 7],
                ],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'     => 200,
            'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage(1, 'ppl', '0001', '1234'));

        $labelsUrl = $service->getLabels($packages);

        $this->assertEquals('https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.', $labelsUrl);
    }
}
