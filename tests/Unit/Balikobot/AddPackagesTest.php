<?php

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Services\Balikobot;

class AddPackagesTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            0        => [
                'carrier_id' => 'NP1504102246M',
                'package_id' => 42719,
                'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                'status'     => '200',
            ],
        ]);
        
        $service = new Balikobot($requester);
        
        $packages = new PackageCollection('ppl', '0001');
        
        $packages->add(new Package(['vs' => '0001', 'rec_name' => 'Name']));
        $packages->add(new Package(['vs' => '0002', 'price' => 2000]));
        
        $service->addPackages($packages);
        
        $requester->shouldHaveReceived(
            'request',
            [
                'https://api.balikobot.cz/ppl/add',
                [
                    0 => [
                        'eid'      => '0001',
                        'vs'       => '0001',
                        'rec_name' => 'Name'
                    ],
                    1 => [
                        'eid'   => '0001',
                        'vs'    => '0002',
                        'price' => 2000
                    ],
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
            0            => [
                'carrier_id' => 'NP1504102246M',
                'package_id' => 42719,
                'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                'status'     => '200',
            ],
            1            => [
                'carrier_id' => 'NP1504102247M',
                'package_id' => 42720,
                'label_url'  => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoB.',
                'status'     => '200',
            ]
        ]);
        
        $service = new Balikobot($requester);
        
        $packages = new PackageCollection('cp', '0001');
        
        $orderedPackages = $service->addPackages($packages);
        
        $this->assertEquals(2, $orderedPackages->count());
        $this->assertEquals([42719, 42720], $orderedPackages->getPackageIds());
        $this->assertEquals('NP1504102247M', $orderedPackages[1]->getCarrierId());
        $this->assertEquals('0001', $orderedPackages[0]->getBatchId());
    }
}
