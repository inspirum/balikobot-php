<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Model\Branch\BranchFactory;
use Inspirum\Balikobot\Model\Branch\DefaultBranchFactory;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Service\Service;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultBranchFactoryTest extends BaseTestCase
{
    public function testStaticConstructor(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'id'                    => '1234',
            'type'                  => 'type',
            'name'                  => 'name',
            'city'                  => 'city',
            'street'                => 'street 27/8',
            'zip'                   => 'zip',
            'country'               => 'country',
            'city_part'             => 'city_part',
            'district'              => 'district',
            'region'                => 'region',
            'currency'              => 'currency',
            'photo_small'           => 'photo_small',
            'photo_big'             => 'photo_big',
            'url'                   => 'url',
            'latitude'              => 123.45,
            'longitude'             => 67.890,
            'directions_global'     => 'directions_global',
            'directions_car'        => 'directions_car',
            'directions_public'     => 'directions_public',
            'wheelchair_accessible' => false,
            'claim_assistant'       => true,
            'dressing_room'         => true,
            'opening_monday'        => 'opening_monday',
            'opening_tuesday'       => 'opening_tuesday',
            'opening_wednesday'     => 'opening_wednesday',
            'opening_thursday'      => 'opening_thursday',
            'opening_friday'        => 'opening_friday',
            'opening_saturday'      => 'opening_saturday',
            'opening_sunday'        => 'opening_sunday',
            'max_weight'            => '5',
        ]);

        self::assertSame('cp', $branch->carrier->getValue());
        self::assertSame('NP', $branch->service?->getValue());
        self::assertSame('1234', $branch->id);
        self::assertSame('type', $branch->type);
        self::assertSame('name', $branch->name);
        self::assertSame('city', $branch->city);
        self::assertSame('street 27/8', $branch->street);
        self::assertSame('zip', $branch->zip);
        self::assertSame('country', $branch->country);
        self::assertSame('city_part', $branch->cityPart);
        self::assertSame('district', $branch->district);
        self::assertSame('region', $branch->region);
        self::assertSame('currency', $branch->currency);
        self::assertSame('photo_small', $branch->photoSmall);
        self::assertSame('photo_big', $branch->photoBig);
        self::assertSame('url', $branch->url);
        self::assertSame(123.45, $branch->latitude);
        self::assertSame(67.890, $branch->longitude);
        self::assertSame('directions_global', $branch->directionsGlobal);
        self::assertSame('directions_car', $branch->directionsCar);
        self::assertSame('directions_public', $branch->directionsPublic);
        self::assertSame(false, $branch->wheelchairAccessible);
        self::assertSame(true, $branch->claimAssistant);
        self::assertSame(true, $branch->dressingRoom);
        self::assertSame('opening_monday', $branch->openingMonday);
        self::assertSame('opening_tuesday', $branch->openingTuesday);
        self::assertSame('opening_wednesday', $branch->openingWednesday);
        self::assertSame('opening_thursday', $branch->openingThursday);
        self::assertSame('opening_friday', $branch->openingFriday);
        self::assertSame('opening_saturday', $branch->openingSaturday);
        self::assertSame('opening_sunday', $branch->openingSunday);
        self::assertSame(5.0, $branch->maxWeight);
    }

    public function testBranchUid(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->createFromData(Carrier::from('ppl'), Service::from('2'), [
            'branch_uid' => '2-ppl-branch-KMBA01081885107',
            'branch_id'  => 'KMBA01081885107',
            'id'         => '1234',
        ]);

        self::assertSame('KMBA01081885107', $branch->id);
        self::assertSame('2-ppl-branch-KMBA01081885107', $branch->uid);
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->createFromData(Carrier::from('ppl'), Service::from('1'), [
            'zip' => 'zip',
        ]);

        self::assertSame('ppl', $branch->carrier->getValue());
        self::assertSame('1', $branch->service?->getValue());
        self::assertSame(null, $branch->id);
        self::assertSame('branch', $branch->type);
        self::assertSame('zip', $branch->name);
        self::assertSame('', $branch->city);
        self::assertSame('', $branch->street);
        self::assertSame('zip', $branch->zip);
        self::assertSame(null, $branch->country);
        self::assertSame(null, $branch->cityPart);
        self::assertSame(null, $branch->district);
        self::assertSame(null, $branch->region);
        self::assertSame(null, $branch->currency);
        self::assertSame(null, $branch->photoSmall);
        self::assertSame(null, $branch->photoBig);
        self::assertSame(null, $branch->url);
        self::assertSame(null, $branch->latitude);
        self::assertSame(null, $branch->longitude);
        self::assertSame(null, $branch->directionsGlobal);
        self::assertSame(null, $branch->directionsCar);
        self::assertSame(null, $branch->directionsPublic);
        self::assertSame(null, $branch->wheelchairAccessible);
        self::assertSame(null, $branch->claimAssistant);
        self::assertSame(null, $branch->dressingRoom);
        self::assertSame(null, $branch->openingMonday);
        self::assertSame(null, $branch->openingTuesday);
        self::assertSame(null, $branch->openingWednesday);
        self::assertSame(null, $branch->openingThursday);
        self::assertSame(null, $branch->openingFriday);
        self::assertSame(null, $branch->openingSaturday);
        self::assertSame(null, $branch->openingSunday);
        self::assertSame(null, $branch->maxWeight);
    }

    public function testStaticConstructorWithMissingDataForCPNP(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip' => 'zip',
        ]);

        self::assertSame('cp', $branch->carrier->getValue());
        self::assertSame('NP', $branch->service?->getValue());
        self::assertSame(null, $branch->id);
        self::assertSame('branch', $branch->type);
        self::assertSame('zip', $branch->name);
        self::assertSame('', $branch->city);
        self::assertSame('', $branch->street);
        self::assertSame('zip', $branch->zip);
        self::assertSame('CZ', $branch->country);
        self::assertSame(null, $branch->cityPart);
        self::assertSame(null, $branch->district);
        self::assertSame(null, $branch->region);
        self::assertSame(null, $branch->currency);
        self::assertSame(null, $branch->photoSmall);
        self::assertSame(null, $branch->photoBig);
        self::assertSame(null, $branch->url);
        self::assertSame(null, $branch->latitude);
        self::assertSame(null, $branch->longitude);
        self::assertSame(null, $branch->directionsGlobal);
        self::assertSame(null, $branch->directionsCar);
        self::assertSame(null, $branch->directionsPublic);
        self::assertSame(null, $branch->wheelchairAccessible);
        self::assertSame(null, $branch->claimAssistant);
        self::assertSame(null, $branch->dressingRoom);
        self::assertSame(null, $branch->openingMonday);
        self::assertSame(null, $branch->openingTuesday);
        self::assertSame(null, $branch->openingWednesday);
        self::assertSame(null, $branch->openingThursday);
        self::assertSame(null, $branch->openingFriday);
        self::assertSame(null, $branch->openingSaturday);
        self::assertSame(null, $branch->openingSunday);
        self::assertSame(null, $branch->maxWeight);
    }

    public function testStaticConstructorFallbackName(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'     => 'zip',
            'address' => 'address',
        ]);

        self::assertSame('zip', $branch->name);
        self::assertSame('branch', $branch->type);
        self::assertSame('address', $branch->street);
    }

    public function testStaticConstructorStreetNumber(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'                => 'zip',
            'street'             => 'street',
            'house_number'       => '8',
            'orientation_number' => '896',
        ]);

        self::assertSame('street 8/896', $branch->street);

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'                => 'zip',
            'street'             => 'street',
            'house_number'       => '8',
            'orientation_number' => '0',
        ]);

        self::assertSame('street 8', $branch->street);

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'                => 'zip',
            'street'             => 'street',
            'orientation_number' => '897',
        ]);

        self::assertSame('street 897', $branch->street);

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'          => 'zip',
            'street'       => 'street',
            'house_number' => '2',
        ]);

        self::assertSame('street 2', $branch->street);

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'                => 'zip',
            'street'             => 'street 1',
            'house_number'       => '2',
            'orientation_number' => '3',
        ]);

        self::assertSame('street 1 2/3', $branch->street);

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'                => 'zip',
            'address'            => 'address',
            'house_number'       => '2',
            'orientation_number' => '3',
        ]);

        self::assertSame('address', $branch->street);

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'                => 'zip',
            'street'             => '',
            'house_number'       => '3',
            'orientation_number' => '4',
        ]);

        self::assertSame('3/4', $branch->street);

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'                => 'zip',
            'city'               => 'Vrbovec',
            'street'             => '',
            'house_number'       => '146',
            'orientation_number' => '0',
        ]);

        self::assertSame('Vrbovec 146', $branch->street);

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'zip'                => 'zip',
            'city'               => 'Vrbovec',
            'street'             => '',
            'address'            => 'address',
            'house_number'       => '147',
            'orientation_number' => '0',
        ]);

        self::assertSame('Vrbovec 147', $branch->street);
    }

    public function testBranchIdResolver(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->createFromData(Carrier::from('cp'), Service::from('NP'), [
            'id'   => 11,
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertSame('11000', $branch->branchId);

        $branch = $factory->createFromData(Carrier::from('sp'), Service::from('NP'), [
            'id'   => '11',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertSame('11000', $branch->branchId);

        $branch = $factory->createFromData(Carrier::from('ulozenka'), Service::from('7'), [
            'id'   => '11',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertSame('11000', $branch->branchId);

        $branch = $factory->createFromData(Carrier::from('ppl'), Service::from('NP'), [
            'id'   => 'KM1234',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertSame('1234', $branch->branchId);

        $branch = $factory->createFromData(Carrier::from('ppl'), Service::from('NP'), [
            'id'   => 'K1M234',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertSame('K1M234', $branch->branchId);

        $branch = $factory->createFromData(Carrier::from('intime'), Service::from('NP'), [
            'id'   => '11',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertSame('Branch Name', $branch->branchId);

        $branch = $factory->createFromData(Carrier::from('zasilkovna'), null, [
            'id'   => '167',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertSame('167', $branch->branchId);
    }

    private function newDefaultBranchFactory(): BranchFactory
    {
        return new DefaultBranchFactory();
    }
}
