<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;

class GetTransportCostsMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $packages = new PackageCollection(Shipper::TOPTRANS);

        $package = new Package();
        $package->setServiceType(ServiceType::TOPTRANS_TOPTIME);
        $package->setBranchId('12');
        $package->setRecName('Tomáš Novák');
        $package->setRecEmail('tets@test.cz');
        $package->setRecZip('12000');
        $package->setRecStreet('Ulice');
        $package->setRecCity('Praha');
        $package->setRecCountry(Country::CZECH_REPUBLIC);
        $package->setRecPhone('776555888');
        $package->setPrice(1000.00);
        $package->setWeight(1.0);
        $package->setMuType('KUS');
        $packages->add($package);

        $transportCosts = $service->getTransportCosts($packages);

        $this->assertEquals(1, $transportCosts->count());
        $this->assertNotEmpty($transportCosts[0]->getTotalCost());
        $this->assertEquals(Shipper::TOPTRANS, $transportCosts->getShipper());
    }

    public function testInvalidRequest(): void
    {
        $service = $this->newBalikobot();

        $packages = new PackageCollection(Shipper::TOPTRANS);

        $package = new Package();
        $package->setServiceType(ServiceType::TOPTRANS_PERSONAL);
        $package->setBranchId('12');
        $package->setRecName('Tomáš Novák');
        $package->setRecEmail('tets@test.cz');
        $package->setRecZip('12000');
        $package->setRecStreet('Ulice');
        $package->setRecCity('Praha');
        $package->setRecCountry(Country::CZECH_REPUBLIC);
        $package->setRecPhone('776555888');
        $package->setPrice(1000.00);
        $package->setWeight(10);
        $packages->add($package);

        try {
            $service->getTransportCosts($packages);
            $this->assertTrue(false, 'ADD request should thrown exception');
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(400, $exception->getStatusCode());
            $this->assertTrue(isset($exception->getErrors()[0]['mu_type_one']));
        }
    }
}
