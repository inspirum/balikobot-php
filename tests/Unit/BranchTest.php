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

        $this->assertEquals('cp', $branch->getShipper());
        $this->assertEquals('NP', $branch->getServiceType());
        $this->assertEquals('1234', $branch->getId());
        $this->assertEquals('type', $branch->getType());
        $this->assertEquals('name', $branch->getName());
        $this->assertEquals('city', $branch->getCity());
        $this->assertEquals('street 27/8', $branch->getStreet());
        $this->assertEquals('zip', $branch->getZip());
        $this->assertEquals('country', $branch->getCountry());
        $this->assertEquals('city_part', $branch->getCityPart());
        $this->assertEquals('district', $branch->getDistrict());
        $this->assertEquals('region', $branch->getRegion());
        $this->assertEquals('currency', $branch->getCurrency());
        $this->assertEquals('photo_small', $branch->getPhotoSmall());
        $this->assertEquals('photo_big', $branch->getPhotoBig());
        $this->assertEquals('url', $branch->getUrl());
        $this->assertEquals(123.45, $branch->getLatitude());
        $this->assertEquals(67.890, $branch->getLongitude());
        $this->assertEquals('directions_global', $branch->getDirectionsGlobal());
        $this->assertEquals('directions_car', $branch->getDirectionsCar());
        $this->assertEquals('directions_public', $branch->getDirectionsPublic());
        $this->assertEquals(false, $branch->getWheelchairAccessible());
        $this->assertEquals(true, $branch->getClaimAssistant());
        $this->assertEquals(true, $branch->getDressingRoom());
        $this->assertEquals('opening_monday', $branch->getOpeningMonday());
        $this->assertEquals('opening_tuesday', $branch->getOpeningTuesday());
        $this->assertEquals('opening_wednesday', $branch->getOpeningWednesday());
        $this->assertEquals('opening_thursday', $branch->getOpeningThursday());
        $this->assertEquals('opening_friday', $branch->getOpeningFriday());
        $this->assertEquals('opening_saturday', $branch->getOpeningSaturday());
        $this->assertEquals('opening_sunday', $branch->getOpeningSunday());
        $this->assertEquals(5.0, $branch->getMaxWeight());
    }

    public function testBranchUid(): void
    {
        $branch = Branch::newInstanceFromData('ppl', '2', [
            'branch_uid' => '2-ppl-branch-KMBA01081885107',
            'branch_id'  => 'KMBA01081885107',
            'id'         => '1234',
        ]);

        $this->assertEquals('KMBA01081885107', $branch->getId());
        $this->assertEquals('2-ppl-branch-KMBA01081885107', $branch->getUId());
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $branch = Branch::newInstanceFromData('ppl', '1', [
            'zip' => 'zip',
        ]);

        $this->assertEquals('ppl', $branch->getShipper());
        $this->assertEquals('1', $branch->getServiceType());
        $this->assertEquals(null, $branch->getId());
        $this->assertEquals('branch', $branch->getType());
        $this->assertEquals('zip', $branch->getName());
        $this->assertEquals(null, $branch->getCity());
        $this->assertEquals(null, $branch->getStreet());
        $this->assertEquals('zip', $branch->getZip());
        $this->assertEquals(null, $branch->getCountry());
        $this->assertEquals(null, $branch->getCityPart());
        $this->assertEquals(null, $branch->getDistrict());
        $this->assertEquals(null, $branch->getRegion());
        $this->assertEquals(null, $branch->getCurrency());
        $this->assertEquals(null, $branch->getPhotoSmall());
        $this->assertEquals(null, $branch->getPhotoBig());
        $this->assertEquals(null, $branch->getUrl());
        $this->assertEquals(null, $branch->getLatitude());
        $this->assertEquals(null, $branch->getLongitude());
        $this->assertEquals(null, $branch->getDirectionsGlobal());
        $this->assertEquals(null, $branch->getDirectionsCar());
        $this->assertEquals(null, $branch->getDirectionsPublic());
        $this->assertEquals(null, $branch->getWheelchairAccessible());
        $this->assertEquals(null, $branch->getClaimAssistant());
        $this->assertEquals(null, $branch->getDressingRoom());
        $this->assertEquals(null, $branch->getOpeningMonday());
        $this->assertEquals(null, $branch->getOpeningTuesday());
        $this->assertEquals(null, $branch->getOpeningWednesday());
        $this->assertEquals(null, $branch->getOpeningThursday());
        $this->assertEquals(null, $branch->getOpeningFriday());
        $this->assertEquals(null, $branch->getOpeningSaturday());
        $this->assertEquals(null, $branch->getOpeningSunday());
        $this->assertEquals(null, $branch->getMaxWeight());
    }

    public function testStaticConstructorWithMissingDataForCPNP(): void
    {
        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip' => 'zip',
        ]);

        $this->assertEquals('cp', $branch->getShipper());
        $this->assertEquals('NP', $branch->getServiceType());
        $this->assertEquals(null, $branch->getId());
        $this->assertEquals('branch', $branch->getType());
        $this->assertEquals('zip', $branch->getName());
        $this->assertEquals(null, $branch->getCity());
        $this->assertEquals(null, $branch->getStreet());
        $this->assertEquals('zip', $branch->getZip());
        $this->assertEquals('CZ', $branch->getCountry());
        $this->assertEquals(null, $branch->getCityPart());
        $this->assertEquals(null, $branch->getDistrict());
        $this->assertEquals(null, $branch->getRegion());
        $this->assertEquals(null, $branch->getCurrency());
        $this->assertEquals(null, $branch->getPhotoSmall());
        $this->assertEquals(null, $branch->getPhotoBig());
        $this->assertEquals(null, $branch->getUrl());
        $this->assertEquals(null, $branch->getLatitude());
        $this->assertEquals(null, $branch->getLongitude());
        $this->assertEquals(null, $branch->getDirectionsGlobal());
        $this->assertEquals(null, $branch->getDirectionsCar());
        $this->assertEquals(null, $branch->getDirectionsPublic());
        $this->assertEquals(null, $branch->getWheelchairAccessible());
        $this->assertEquals(null, $branch->getClaimAssistant());
        $this->assertEquals(null, $branch->getDressingRoom());
        $this->assertEquals(null, $branch->getOpeningMonday());
        $this->assertEquals(null, $branch->getOpeningTuesday());
        $this->assertEquals(null, $branch->getOpeningWednesday());
        $this->assertEquals(null, $branch->getOpeningThursday());
        $this->assertEquals(null, $branch->getOpeningFriday());
        $this->assertEquals(null, $branch->getOpeningSaturday());
        $this->assertEquals(null, $branch->getOpeningSunday());
        $this->assertEquals(null, $branch->getMaxWeight());
    }

    public function testStaticConstructorFallbackName(): void
    {
        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'     => 'zip',
            'address' => 'address',
        ]);

        $this->assertEquals('zip', $branch->getName());
        $this->assertEquals('branch', $branch->getType());
        $this->assertEquals('address', $branch->getStreet());
    }

    public function testStaticConstructorStreetNumber(): void
    {
        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => 'street',
            'house_number'       => '8',
            'orientation_number' => '896',
        ]);

        $this->assertEquals('street 8/896', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => 'street',
            'house_number'       => '8',
            'orientation_number' => '0',
        ]);

        $this->assertEquals('street 8', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => 'street',
            'orientation_number' => '897',
        ]);

        $this->assertEquals('street 897', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'          => 'zip',
            'street'       => 'street',
            'house_number' => '2',
        ]);

        $this->assertEquals('street 2', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => 'street 1',
            'house_number'       => '2',
            'orientation_number' => '3',
        ]);

        $this->assertEquals('street 1 2/3', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'address'            => 'address',
            'house_number'       => '2',
            'orientation_number' => '3',
        ]);

        $this->assertEquals('address', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'street'             => '',
            'house_number'       => '3',
            'orientation_number' => '4',
        ]);

        $this->assertEquals('3/4', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'city'               => 'Vrbovec',
            'street'             => '',
            'house_number'       => '146',
            'orientation_number' => '0',
        ]);

        $this->assertEquals('Vrbovec 146', $branch->getStreet());

        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'zip'                => 'zip',
            'city'               => 'Vrbovec',
            'street'             => '',
            'address'            => 'address',
            'house_number'       => '147',
            'orientation_number' => '0',
        ]);

        $this->assertEquals('Vrbovec 147', $branch->getStreet());
    }

    public function testBranchIdResolver(): void
    {
        $branch = Branch::newInstanceFromData('cp', 'NP', [
            'id'   => 11,
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        $this->assertEquals('11000', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('sp', 'NP', [
            'id'   => '11',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        $this->assertEquals('11000', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('ulozenka', '7', [
            'id'   => '11',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        $this->assertEquals('11000', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('ppl', 'NP', [
            'id'   => 'KM1234',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        $this->assertEquals('1234', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('ppl', 'NP', [
            'id'   => 'K1M234',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        $this->assertEquals('K1M234', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('intime', 'NP', [
            'id'   => '11',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        $this->assertEquals('Branch Name', $branch->getBranchId());

        $branch = Branch::newInstanceFromData('zasilkovna', null, [
            'id'   => '167',
            'name' => 'Branch Name',
            'zip'  => '110 00',
        ]);

        $this->assertEquals('167', $branch->getBranchId());
    }
}
