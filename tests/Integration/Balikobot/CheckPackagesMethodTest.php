<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Model\Aggregates\PackageCollection;
use Inspirum\Balikobot\Model\Values\Package;

class CheckPackagesMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
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

        $service->checkPackages($packages);

        self::assertTrue(true);
    }

    public function testMissingBranchId(): void
    {
        $service = $this->newBalikobot();

        $packages = new PackageCollection(Shipper::ZASILKOVNA);

        $package = new Package();
        $package->setServiceType(ServiceType::ZASILKOVNA_VMCZ);
        $package->setBranchId('X');
        $package->setRecName('Tomáš Novák');
        $package->setRecEmail('tets@test.cz');
        $package->setRecZip('12000');
        $package->setRecStreet('Ulice');
        $package->setRecCity('Praha');
        $package->setRecCountry(Country::CZECH_REPUBLIC);
        $package->setRecPhone('776555888');
        $package->setPrice(1000.00);
        $packages->add($package);

        try {
            $service->checkPackages($packages);
            self::assertTrue(false, 'CHECK request should thrown exception');
        } catch (ExceptionInterface $exception) {
            self::assertEquals(400, $exception->getStatusCode());
            self::assertTrue(isset($exception->getErrors()[0]['branch_id']));
        }
    }
}
