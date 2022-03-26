<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Aggregates\OrderedPackageCollection;
use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\OrderedPackage;
use Inspirum\Balikobot\Model\Values\Package;

class OrderShipmentMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $packages = new PackageCollection(Shipper::CP);

        $package = new Package();
        $package->setServiceType(ServiceType::CP_DR);
        $package->setBranchId('12');
        $package->setRecName('Tomáš Novák');
        $package->setRecEmail('tets@test.cz');
        $package->setRecZip('12000');
        $package->setRecStreet('Ulice');
        $package->setRecCity('Praha');
        $package->setRecCountry(Country::CZECH_REPUBLIC);
        $package->setRecPhone('776555888');
        $package->setPrice(1000.00);
        $packages->add($package);

        $orderPackages = $service->addPackages($packages);

        $orderedShipment = $service->orderShipment($orderPackages);

        self::assertEquals(Shipper::CP, $orderedShipment->getShipper());
        self::assertNotEmpty($orderedShipment->getOrderId());

        self::assertTrue(true);
    }

    public function testInvalidRequest(): void
    {
        $service = $this->newBalikobot();

        $packages = new OrderedPackageCollection();

        $packages->add(new OrderedPackage('12345', Shipper::PPL, '0001', '1234'));

        try {
            $service->orderShipment($packages);
            self::fail('ORDER request should thrown exception');
        } catch (ExceptionInterface $exception) {
            self::assertEquals(406, $exception->getStatusCode());
        }
    }
}
