<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Model\Values\Branch;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class BranchTest extends AbstractTestCase
{
    public function testStaticConstructor(): void
    {
        $branch = Branch::newInstanceFromData('cp', 'NP', [
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

        self::assertEquals('cp', $branch->getShipper());
        self::assertEquals('NP', $branch->getServiceType());
        self::assertEquals('1234', $branch->getId());
        self::assertEquals('type', $branch->getType());
        self::assertEquals('name', $branch->getName());
        self::assertEquals('city', $branch->getCity());
        self::assertEquals('street 27/8', $branch->getStreet());
        self::assertEquals('zip', $branch->getZip());
        self::assertEquals('country', $branch->getCountry());
        self::assertEquals('city_part', $branch->getCityPart());
        self::assertEquals('district', $branch->getDistrict());
        self::assertEquals('region', $branch->getRegion());
        self::assertEquals('currency', $branch->getCurrency());
        self::assertEquals('photo_small', $branch->getPhotoSmall());
        self::assertEquals('photo_big', $branch->getPhotoBig());
        self::assertEquals('url', $branch->getUrl());
        self::assertEquals(123.45, $branch->getLatitude());
        self::assertEquals(67.890, $branch->getLongitude());
        self::assertEquals('directions_global', $branch->getDirectionsGlobal());
        self::assertEquals('directions_car', $branch->getDirectionsCar());
        self::assertEquals('directions_public', $branch->getDirectionsPublic());
        self::assertEquals(false, $branch->getWheelchairAccessible());
        self::assertEquals(true, $branch->getClaimAssistant());
        self::assertEquals(true, $branch->getDressingRoom());
        self::assertEquals('opening_monday', $branch->getOpeningMonday());
        self::assertEquals('opening_tuesday', $branch->getOpeningTuesday());
        self::assertEquals('opening_wednesday', $branch->getOpeningWednesday());
        self::assertEquals('opening_thursday', $branch->getOpeningThursday());
        self::assertEquals('opening_friday', $branch->getOpeningFriday());
        self::assertEquals('opening_saturday', $branch->getOpeningSaturday());
        self::assertEquals('opening_sunday', $branch->getOpeningSunday());
        self::assertEquals(5.0, $branch->getMaxWeight());
    }

    public function testBranchUid(): void
    {
        $branch = Branch::newInstanceFromData('ppl', '2', [
            'branch_uid' => '2-ppl-branch-KMBA01081885107',
            'branch_id'  => 'KMBA01081885107',
            'id'         => '1234',
        ]);

        self::assertEquals('KMBA01081885107', $branch->getId());
        self::assertEquals('2-ppl-branch-KMBA01081885107', $branch->getUId());
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $branch = Branch::newInstanceFromData('ppl', '1', [
            'zip' => 'zip',
        ]);

        self::assertEquals('ppl', $branch->getShipper());
        self::assertEquals('1', $branch->getServiceType());
        self::assertEquals(null, $branch->getId());
        self::assertEquals('branch', $branch->getType());
        self::assertEquals('zip', $branch->getName());
        self::assertEquals(null, $branch->getCity());
        self::assertEquals(null, $branch->getStreet());
        self::assertEquals('zip', $branch->getZip());
        self::assertEquals(null, $branch->getCountry());
        self::assertEquals(null, $branch->getCityPart());
        self::assertEquals(null, $branch->getDistrict());
        self::assertEquals(null, $branch->getRegion());
        self::assertEquals(null, $branch->getCurrency());
        self::assertEquals(null, $branch->getPhotoSmall());
        self::assertEquals(null, $branch->getPhotoBig());
        self::assertEquals(null, $branch->getUrl());
        self::assertEquals(null, $branch->getLatitude());
        self::assertEquals(null, $branch->getLongitude());
        self::assertEquals(null, $branch->getDirectionsGlobal());
        self::assertEquals(null, $branch->getDirectionsCar());
        self::assertEquals(null, $branch->getDirectionsPublic());
        self::assertEquals(null, $branch->getWheelchairAccessible());
        self::assertEquals(null, $branch->getClaimAssistant());
        self::assertEquals(null, $branch->getDressingRoom());
        self::assertEquals(null, $branch->getOpeningMonday());
        self::assertEquals(null, $branch->getOpeningTuesday());
        self::assertEquals(null, $branch->getOpeningWednesday());
        self::assertEquals(null, $branch->getOpeningThursday());
        self::assertEquals(null, $branch->getOpeningFriday());
        self::assertEquals(null, $branch->getOpeningSaturday());
        self::assertEquals(null, $branch->getOpeningSunday());
        self::assertEquals(null, $branch->getMaxWeight());
    }

    public function testStaticConstructorWithMissingDataForCPNP(): void
    {
        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip' => 'zip',
        ]);

        self::assertEquals('cp', $branch->getShipper());
        self::assertEquals('NP', $branch->getServiceType());
        self::assertEquals(null, $branch->getId());
        self::assertEquals('branch', $branch->getType());
        self::assertEquals('zip', $branch->getName());
        self::assertEquals(null, $branch->getCity());
        self::assertEquals(null, $branch->getStreet());
        self::assertEquals('zip', $branch->getZip());
        self::assertEquals('CZ', $branch->getCountry());
        self::assertEquals(null, $branch->getCityPart());
        self::assertEquals(null, $branch->getDistrict());
        self::assertEquals(null, $branch->getRegion());
        self::assertEquals(null, $branch->getCurrency());
        self::assertEquals(null, $branch->getPhotoSmall());
        self::assertEquals(null, $branch->getPhotoBig());
        self::assertEquals(null, $branch->getUrl());
        self::assertEquals(null, $branch->getLatitude());
        self::assertEquals(null, $branch->getLongitude());
        self::assertEquals(null, $branch->getDirectionsGlobal());
        self::assertEquals(null, $branch->getDirectionsCar());
        self::assertEquals(null, $branch->getDirectionsPublic());
        self::assertEquals(null, $branch->getWheelchairAccessible());
        self::assertEquals(null, $branch->getClaimAssistant());
        self::assertEquals(null, $branch->getDressingRoom());
        self::assertEquals(null, $branch->getOpeningMonday());
        self::assertEquals(null, $branch->getOpeningTuesday());
        self::assertEquals(null, $branch->getOpeningWednesday());
        self::assertEquals(null, $branch->getOpeningThursday());
        self::assertEquals(null, $branch->getOpeningFriday());
        self::assertEquals(null, $branch->getOpeningSaturday());
        self::assertEquals(null, $branch->getOpeningSunday());
        self::assertEquals(null, $branch->getMaxWeight());
    }

    public function testStaticConstructorFallbackName(): void
    {
        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'     => 'zip',
            'address' => 'address',
        ]);

        self::assertEquals('zip', $branch->getName());
        self::assertEquals('branch', $branch->getType());
        self::assertEquals('address', $branch->getStreet());
    }

    public function testStaticConstructorStreetNumber(): void
    {
        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => 'street',
            'house_number'       => '8',
            'orientation_number' => '896',
        ]);

        self::assertEquals('street 8/896', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => 'street',
            'house_number'       => '8',
            'orientation_number' => '0',
        ]);

        self::assertEquals('street 8', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => 'street',
            'orientation_number' => '897',
        ]);

        self::assertEquals('street 897', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'          => 'zip',
            'street'       => 'street',
            'house_number' => '2',
        ]);

        self::assertEquals('street 2', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => 'street 1',
            'house_number'       => '2',
            'orientation_number' => '3',
        ]);

        self::assertEquals('street 1 2/3', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'address'            => 'address',
            'house_number'       => '2',
            'orientation_number' => '3',
        ]);

        self::assertEquals('address', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => '',
            'house_number'       => '3',
            'orientation_number' => '4',
        ]);

        self::assertEquals('3/4', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'city'               => 'Vrbovec',
            'street'             => '',
            'house_number'       => '146',
            'orientation_number' => '0',
        ]);

        self::assertEquals('Vrbovec 146', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'city'               => 'Vrbovec',
            'street'             => '',
            'address'            => 'address',
            'house_number'       => '147',
            'orientation_number' => '0',
        ]);

        self::assertEquals('Vrbovec 147', $branch->getStreet());
    }

    public function testBranchIdResolver(): void
    {
        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'id'   => 11,
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertEquals('11000', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('sp', 'NP', [
            'id'   => '11',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertEquals('11000', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('ulozenka', '7', [
            'id'   => '11',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertEquals('11000', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('ppl', 'NP', [
            'id'   => 'KM1234',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertEquals('1234', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('ppl', 'NP', [
            'id'   => 'K1M234',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertEquals('K1M234', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('intime', 'NP', [
            'id'   => '11',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertEquals('Branch Name', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('zasilkovna', null, [
            'id'   => '167',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        self::assertEquals('167', $branch->getBranchId());
    }
}
