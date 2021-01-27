<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;

class GetOrderMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest()
    {
        $service = $this->newBalikobot();

        $packages = new PackageCollection(Shipper::ZASILKOVNA);

        $package = new Package();
        $package->setServiceType(ServiceType::ZASILKOVNA_VMCZ);
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

        $orderedShipmentData = $service->getOrder($orderedShipment->getShipper(), $orderedShipment->getOrderId());

        $this->assertEquals($orderedShipment, $orderedShipmentData);
    }

    public function testInvalidRequest()
    {
        $service = $this->newBalikobot();

        try {
            $service->getOrder(Shipper::PPL, '1234');
            $this->assertTrue(false, 'ORDERVIEW request should thrown exception');
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(406, $exception->getStatusCode());
        }
    }
}
