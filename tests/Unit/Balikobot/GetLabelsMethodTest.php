<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Services\Balikobot;

class GetLabelsMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'     => 200,
            'labels_url' => 'http://pdf.balikobot.cz/dpd/eNorMdY1NFwwXDAELgE2',
        ]);

        $service = new Balikobot($requester);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage('1', 'ppl', '0001', '1234'));
        $packages->add(new OrderedPackage('7', 'ppl', '0001', '5678'));

        $service->getLabels($packages);

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/labels',
                [
                    'package_ids' => ['1', '7'],
                ],
            ]
        );

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'     => 200,
            'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
        ]);

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage('1', 'ppl', '0001', '1234'));

        $labelsUrl = $service->getLabels($packages);

        self::assertEquals('https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.', $labelsUrl);
    }
}
