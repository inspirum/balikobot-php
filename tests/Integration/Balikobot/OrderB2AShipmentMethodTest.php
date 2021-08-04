<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;

class OrderB2AShipmentMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $packages = new PackageCollection(Shipper::PPL);

        $package = new Package();
        $package->setServiceType(ServiceType::PPL_PARCEL_BUSSINESS_CZ);
        $package->setRecName('Tomáš Novák');
        $package->setRecEmail('tets@test.cz');
        $package->setRecZip('12000');
        $package->setRecStreet('Ulice');
        $package->setRecCity('Praha');
        $package->setRecCountry(Country::CZECH_REPUBLIC);
        $package->setRecPhone('776555888');
        $package->setPrice(1000.00);
        $packages->add($package);

        $orderPackages = $service->orderB2AShipment($packages);

        $this->assertCount(1, $orderPackages->getPackageIds());
        $this->assertEquals(Shipper::PPL, $orderPackages->getShipper());
    }

    public function testMissingBranchId(): void
    {
        $service = $this->newBalikobot();

        $packages = new PackageCollection(Shipper::PPL);

        $package = new Package();
        $package->setServiceType(ServiceType::PPL_PARCEL_BUSSINESS_CZ);
        $package->setRecName('Tomáš Novák');
        $package->setRecZip('12000');
        $package->setRecStreet('Ulice');
        $package->setRecCountry(Country::CZECH_REPUBLIC);
        $packages->add($package);

        try {
            $service->orderB2AShipment($packages);
            $this->assertTrue(false, 'B2A request should thrown exception');
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(400, $exception->getStatusCode());
            $this->assertTrue(isset($exception->getErrors()[0]['rec_city']));
        }
    }
}
