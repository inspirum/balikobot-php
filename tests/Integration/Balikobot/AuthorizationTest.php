<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Exceptions\UnauthorizedException;
use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;

class AuthorizationTest extends AbstractBalikobotTestCase
{
    public function testWrongAuthorizationException()
    {
        $this->expectException(UnauthorizedException::class);
        
        $service = $this->newBalikobot('wrong', 'auth');
        
        $service->getServices('cp');
    }
    
    public function testAuthorization()
    {
        $service = $this->newBalikobot('balikobot_test2cztest', '#lS1tBVo');
        
        $packages = new PackageCollection(Shipper::CP);
        
        $package = new Package();
        $package->setServiceType(ServiceType::CP_NP);
        $package->setRecName('Josef Novak');
        $package->setRecCity('Praha');
        $package->setRecStreet('Ulice');
        $package->setRecZip('17000');
        $package->setRecCountry(Country::CZECH_REPUBLIC);
        $package->setRecPhone('777666555');
        $package->setPrice(2000);
        $packages->add($package);
        
        $orderedPackages = $service->addPackages($packages);
        
        $this->assertNotEmpty($orderedPackages[0]->getPackageId());
    }
}
