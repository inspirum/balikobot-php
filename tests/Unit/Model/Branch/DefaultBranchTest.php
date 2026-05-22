<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Branch;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\Branch\DefaultBranch;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultBranchTest extends BaseTestCase
{
    public function testGetter(): void
    {
        $model = new DefaultBranch(
            carrier: Carrier::CP,
            service: '1',
            branchId: 'branch1',
            id: 'id1',
            uid: 'uid1',
            type: 'post',
            name: 'Name',
            city: 'City',
            street: 'Street 1',
            zip: '12345',
            country: 'CZ',
            cityPart: 'Part',
            district: 'District',
            region: 'Region',
            currency: 'CZK',
            photoSmall: 'small.jpg',
            photoBig: 'big.jpg',
            url: 'https://example.com',
            latitude: 50.0,
            longitude: 14.0,
            directionsGlobal: 'global',
            directionsCar: 'car',
            directionsPublic: 'public',
            wheelchairAccessible: true,
            claimAssistant: false,
            dressingRoom: true,
            openingMonday: '8:00-18:00',
            openingTuesday: '8:00-18:00',
            openingWednesday: '8:00-18:00',
            openingThursday: '8:00-18:00',
            openingFriday: '8:00-16:00',
            openingSaturday: '9:00-12:00',
            openingSunday: null,
            maxWeight: 30.0,
        );

        self::assertSame(Carrier::CP, $model->getCarrier());
        self::assertSame('1', $model->getService());
        self::assertSame('branch1', $model->getBranchId());
        self::assertSame('id1', $model->getId());
        self::assertSame('uid1', $model->getUid());
        self::assertSame('post', $model->getType());
        self::assertSame('Name', $model->getName());
        self::assertSame('City', $model->getCity());
        self::assertSame('Street 1', $model->getStreet());
        self::assertSame('12345', $model->getZip());
        self::assertSame('CZ', $model->getCountry());
        self::assertSame('Part', $model->getCityPart());
        self::assertSame('District', $model->getDistrict());
        self::assertSame('Region', $model->getRegion());
        self::assertSame('CZK', $model->getCurrency());
        self::assertSame('small.jpg', $model->getPhotoSmall());
        self::assertSame('big.jpg', $model->getPhotoBig());
        self::assertSame('https://example.com', $model->getUrl());
        self::assertSame(50.0, $model->getLatitude());
        self::assertSame(14.0, $model->getLongitude());
        self::assertSame('global', $model->getDirectionsGlobal());
        self::assertSame('car', $model->getDirectionsCar());
        self::assertSame('public', $model->getDirectionsPublic());
        self::assertTrue($model->getWheelchairAccessible());
        self::assertFalse($model->getClaimAssistant());
        self::assertTrue($model->getDressingRoom());
        self::assertSame('8:00-18:00', $model->getOpeningMonday());
        self::assertSame('8:00-18:00', $model->getOpeningTuesday());
        self::assertSame('8:00-18:00', $model->getOpeningWednesday());
        self::assertSame('8:00-18:00', $model->getOpeningThursday());
        self::assertSame('8:00-16:00', $model->getOpeningFriday());
        self::assertSame('9:00-12:00', $model->getOpeningSaturday());
        self::assertNull($model->getOpeningSunday());
        self::assertSame(30.0, $model->getMaxWeight());
        self::assertSame([
            'carrier' => 'cp',
            'service' => '1',
            'branchId' => 'branch1',
            'id' => 'id1',
            'uid' => 'uid1',
            'type' => 'post',
            'name' => 'Name',
            'city' => 'City',
            'street' => 'Street 1',
            'zip' => '12345',
            'country' => 'CZ',
            'cityPart' => 'Part',
            'district' => 'District',
            'region' => 'Region',
            'currency' => 'CZK',
            'photoSmall' => 'small.jpg',
            'photoBig' => 'big.jpg',
            'url' => 'https://example.com',
            'latitude' => 50.0,
            'longitude' => 14.0,
            'directionsGlobal' => 'global',
            'directionsCar' => 'car',
            'directionsPublic' => 'public',
            'wheelchairAccessible' => true,
            'claimAssistant' => false,
            'dressingRoom' => true,
            'openingMonday' => '8:00-18:00',
            'openingTuesday' => '8:00-18:00',
            'openingWednesday' => '8:00-18:00',
            'openingThursday' => '8:00-18:00',
            'openingFriday' => '8:00-16:00',
            'openingSaturday' => '9:00-12:00',
            'openingSunday' => null,
            'maxWeight' => 30.0,
        ], $model->__toArray());
    }

    public function testGetterWithNullableDefaults(): void
    {
        $model = new DefaultBranch(
            carrier: Carrier::CP,
            service: null,
            branchId: 'branch1',
            id: null,
            uid: null,
            type: 'post',
            name: 'Name',
            city: 'City',
            street: 'Street 1',
            zip: '12345',
        );

        self::assertNull($model->getService());
        self::assertNull($model->getId());
        self::assertNull($model->getUid());
        self::assertNull($model->getCountry());
        self::assertNull($model->getCityPart());
        self::assertNull($model->getDistrict());
        self::assertNull($model->getRegion());
        self::assertNull($model->getCurrency());
        self::assertNull($model->getPhotoSmall());
        self::assertNull($model->getPhotoBig());
        self::assertNull($model->getUrl());
        self::assertNull($model->getLatitude());
        self::assertNull($model->getLongitude());
        self::assertNull($model->getDirectionsGlobal());
        self::assertNull($model->getDirectionsCar());
        self::assertNull($model->getDirectionsPublic());
        self::assertNull($model->getWheelchairAccessible());
        self::assertNull($model->getClaimAssistant());
        self::assertNull($model->getDressingRoom());
        self::assertNull($model->getOpeningMonday());
        self::assertNull($model->getOpeningSunday());
        self::assertNull($model->getMaxWeight());
    }
}
