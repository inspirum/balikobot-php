<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Branch;

use ArrayIterator;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Model\Branch\BranchFactory;
use Inspirum\Balikobot\Model\Branch\BranchIterator;
use Inspirum\Balikobot\Model\Branch\DefaultBranch;
use Inspirum\Balikobot\Model\Branch\DefaultBranchFactory;
use Inspirum\Balikobot\Model\Branch\DefaultBranchIterator;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Throwable;
use Traversable;
use function iterator_to_array;

final class DefaultBranchFactoryTest extends BaseTestCase
{
    /**
     * @param array<string> $countries
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestCreateIterator')]
    public function testCreateIterator(string $carrier, ?string $service, ?array $countries, array $data, BranchIterator|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultBranchFactory();

        $iterator = $factory->createIterator($carrier, $service, $countries, $data);

        self::assertEquals($result, $iterator);
        if ($result instanceof Traversable) {
            self::assertEquals(iterator_to_array($result), iterator_to_array($iterator));
        }
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public static function providesTestCreateIterator(): iterable
    {
        yield 'valid' => [
            'carrier' => Carrier::CP,
            'service' => null,
            'countries' => null,
            'data' => [
                'branches' => [
                    [
                        'id' => '1234',
                        'type' => 'type1',
                        'name' => 'name1',
                        'city' => 'city1',
                        'street' => 'street 27/8',
                        'zip' => '11000',
                    ],
                    [
                        'id' => '1235',
                        'type' => 'type2',
                        'name' => 'name2',
                        'city' => 'city2',
                        'street' => 'street 27/9',
                        'zip' => '12000',
                    ],
                ],
            ],
            'result' => new DefaultBranchIterator(
                Carrier::CP,
                null,
                null,
                new ArrayIterator([
                    new DefaultBranch(
                        Carrier::CP,
                        null,
                        '11000',
                        '1234',
                        null,
                        'type1',
                        'name1',
                        'city1',
                        'street 27/8',
                        '11000',
                    ),
                    new DefaultBranch(
                        Carrier::CP,
                        null,
                        '12000',
                        '1235',
                        null,
                        'type2',
                        'name2',
                        'city2',
                        'street 27/9',
                        '12000',
                    ),
                ]),
            ),
        ];
    }

    /**
     * @param array<string> $countries
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestWrapIterator')]
    public function testWrapIterator(string $carrier, ?string $service, ?array $countries, array $data, BranchIterator $result): void
    {
        $factory = $this->newDefaultBranchFactory();

        $iterator = $factory->wrapIterator($carrier, $service, $countries, $result->getInnerIterator());

        self::assertEquals($result, $iterator);
        self::assertEquals(iterator_to_array($result), iterator_to_array($iterator));
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public static function providesTestWrapIterator(): iterable
    {
        yield 'valid' => [
            'carrier' => Carrier::CP,
            'service' => null,
            'countries' => [Country::CZECH_REPUBLIC],
            'data' => [
                'branches' => [
                    [
                        'id' => '1234',
                        'type' => 'type1',
                        'name' => 'name1',
                        'city' => 'city1',
                        'street' => 'street 27/8',
                        'zip' => '11000',
                    ],
                    [
                        'id' => '1235',
                        'type' => 'type2',
                        'name' => 'name2',
                        'city' => 'city2',
                        'street' => 'street 27/9',
                        'zip' => '12000',
                    ],
                ],
            ],
            'result' => new DefaultBranchIterator(
                Carrier::CP,
                null,
                [Country::CZECH_REPUBLIC],
                new ArrayIterator([
                    new DefaultBranch(
                        Carrier::CP,
                        null,
                        '11000',
                        '1234',
                        null,
                        'type1',
                        'name1',
                        'city1',
                        'street 27/8',
                        '11000',
                    ),
                    new DefaultBranch(
                        Carrier::CP,
                        null,
                        '12000',
                        '1235',
                        null,
                        'type2',
                        'name2',
                        'city2',
                        'street 27/9',
                        '12000',
                    ),
                ]),
            ),
        ];
    }

    public function testStaticConstructor(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->create('cp', 'NP', [
            'id' => '1234',
            'type' => 'type',
            'name' => 'name',
            'city' => 'city',
            'street' => 'street 27/8',
            'zip' => 'zip',
            'country' => 'country',
            'city_part' => 'city_part',
            'district' => 'district',
            'region' => 'region',
            'currency' => 'currency',
            'photo_small' => 'photo_small',
            'photo_big' => 'photo_big',
            'url' => 'url',
            'latitude' => 123.45,
            'longitude' => 67.890,
            'directions_global' => 'directions_global',
            'directions_car' => 'directions_car',
            'directions_public' => 'directions_public',
            'wheelchair_accessible' => false,
            'claim_assistant' => true,
            'dressing_room' => true,
            'opening_monday' => 'opening_monday',
            'opening_tuesday' => 'opening_tuesday',
            'opening_wednesday' => 'opening_wednesday',
            'opening_thursday' => 'opening_thursday',
            'opening_friday' => 'opening_friday',
            'opening_saturday' => 'opening_saturday',
            'opening_sunday' => 'opening_sunday',
            'max_weight' => '5',
        ]);

        self::assertSame('cp', $branch->getCarrier());
        self::assertSame('NP', $branch->getService());
        self::assertSame('1234', $branch->getId());
        self::assertSame('type', $branch->getType());
        self::assertSame('name', $branch->getName());
        self::assertSame('city', $branch->getCity());
        self::assertSame('street 27/8', $branch->getStreet());
        self::assertSame('zip', $branch->getZip());
        self::assertSame('country', $branch->getCountry());
        self::assertSame('city_part', $branch->getCityPart());
        self::assertSame('district', $branch->getDistrict());
        self::assertSame('region', $branch->getRegion());
        self::assertSame('currency', $branch->getCurrency());
        self::assertSame('photo_small', $branch->getPhotoSmall());
        self::assertSame('photo_big', $branch->getPhotoBig());
        self::assertSame('url', $branch->getUrl());
        self::assertSame(123.45, $branch->getLatitude());
        self::assertSame(67.890, $branch->getLongitude());
        self::assertSame('directions_global', $branch->getDirectionsGlobal());
        self::assertSame('directions_car', $branch->getDirectionsCar());
        self::assertSame('directions_public', $branch->getDirectionsPublic());
        self::assertSame(false, $branch->getWheelchairAccessible());
        self::assertSame(true, $branch->getClaimAssistant());
        self::assertSame(true, $branch->getDressingRoom());
        self::assertSame('opening_monday', $branch->getOpeningMonday());
        self::assertSame('opening_tuesday', $branch->getOpeningTuesday());
        self::assertSame('opening_wednesday', $branch->getOpeningWednesday());
        self::assertSame('opening_thursday', $branch->getOpeningThursday());
        self::assertSame('opening_friday', $branch->getOpeningFriday());
        self::assertSame('opening_saturday', $branch->getOpeningSaturday());
        self::assertSame('opening_sunday', $branch->getOpeningSunday());
        self::assertSame(5.0, $branch->getMaxWeight());
        self::assertSame([
            'carrier' => 'cp',
            'service' => 'NP',
            'branchId' => 'zip',
            'id' => '1234',
            'uid' => null,
            'type' => 'type',
            'name' => 'name',
            'city' => 'city',
            'street' => 'street 27/8',
            'zip' => 'zip',
            'country' => 'country',
            'cityPart' => 'city_part',
            'district' => 'district',
            'region' => 'region',
            'currency' => 'currency',
            'photoSmall' => 'photo_small',
            'photoBig' => 'photo_big',
            'url' => 'url',
            'latitude' => 123.45,
            'longitude' => 67.890,
            'directionsGlobal' => 'directions_global',
            'directionsCar' => 'directions_car',
            'directionsPublic' => 'directions_public',
            'wheelchairAccessible' => false,
            'claimAssistant' => true,
            'dressingRoom' => true,
            'openingMonday' => 'opening_monday',
            'openingTuesday' => 'opening_tuesday',
            'openingWednesday' => 'opening_wednesday',
            'openingThursday' => 'opening_thursday',
            'openingFriday' => 'opening_friday',
            'openingSaturday' => 'opening_saturday',
            'openingSunday' => 'opening_sunday',
            'maxWeight' => 5.0,
        ], $branch->__toArray());
    }

    public function testBranchUid(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->create('ppl', '2', [
            'branch_uid' => '2-ppl-branch-KMBA01081885107',
            'branch_id' => 'KMBA01081885107',
            'id' => '1234',
        ]);

        self::assertSame('KMBA01081885107', $branch->getId());
        self::assertSame('2-ppl-branch-KMBA01081885107', $branch->getUid());
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->create('ppl', '1', [
            'zip' => 'zip',
        ]);

        self::assertSame('ppl', $branch->getCarrier());
        self::assertSame('1', $branch->getService());
        self::assertSame(null, $branch->getId());
        self::assertSame('branch', $branch->getType());
        self::assertSame('zip', $branch->getName());
        self::assertSame('', $branch->getCity());
        self::assertSame('', $branch->getStreet());
        self::assertSame('zip', $branch->getZip());
        self::assertSame(null, $branch->getCountry());
        self::assertSame(null, $branch->getCityPart());
        self::assertSame(null, $branch->getDistrict());
        self::assertSame(null, $branch->getRegion());
        self::assertSame(null, $branch->getCurrency());
        self::assertSame(null, $branch->getPhotoSmall());
        self::assertSame(null, $branch->getPhotoBig());
        self::assertSame(null, $branch->getUrl());
        self::assertSame(null, $branch->getLatitude());
        self::assertSame(null, $branch->getLongitude());
        self::assertSame(null, $branch->getDirectionsGlobal());
        self::assertSame(null, $branch->getDirectionsCar());
        self::assertSame(null, $branch->getDirectionsPublic());
        self::assertSame(null, $branch->getWheelchairAccessible());
        self::assertSame(null, $branch->getClaimAssistant());
        self::assertSame(null, $branch->getDressingRoom());
        self::assertSame(null, $branch->getOpeningMonday());
        self::assertSame(null, $branch->getOpeningTuesday());
        self::assertSame(null, $branch->getOpeningWednesday());
        self::assertSame(null, $branch->getOpeningThursday());
        self::assertSame(null, $branch->getOpeningFriday());
        self::assertSame(null, $branch->getOpeningSaturday());
        self::assertSame(null, $branch->getOpeningSunday());
        self::assertSame(null, $branch->getmaxWeight());
    }

    public function testStaticConstructorWithMissingDataForCPNP(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
        ]);

        self::assertSame('cp', $branch->getCarrier());
        self::assertSame('NP', $branch->getservice());
        self::assertSame(null, $branch->getId());
        self::assertSame('branch', $branch->getType());
        self::assertSame('zip', $branch->getName());
        self::assertSame('', $branch->getCity());
        self::assertSame('', $branch->getStreet());
        self::assertSame('zip', $branch->getZip());
        self::assertSame('CZ', $branch->getCountry());
        self::assertSame(null, $branch->getCityPart());
        self::assertSame(null, $branch->getDistrict());
        self::assertSame(null, $branch->getRegion());
        self::assertSame(null, $branch->getCurrency());
        self::assertSame(null, $branch->getPhotoSmall());
        self::assertSame(null, $branch->getPhotoBig());
        self::assertSame(null, $branch->getUrl());
        self::assertSame(null, $branch->getLatitude());
        self::assertSame(null, $branch->getLongitude());
        self::assertSame(null, $branch->getDirectionsGlobal());
        self::assertSame(null, $branch->getDirectionsCar());
        self::assertSame(null, $branch->getDirectionsPublic());
        self::assertSame(null, $branch->getWheelchairAccessible());
        self::assertSame(null, $branch->getClaimAssistant());
        self::assertSame(null, $branch->getDressingRoom());
        self::assertSame(null, $branch->getOpeningMonday());
        self::assertSame(null, $branch->getOpeningTuesday());
        self::assertSame(null, $branch->getOpeningWednesday());
        self::assertSame(null, $branch->getOpeningThursday());
        self::assertSame(null, $branch->getOpeningFriday());
        self::assertSame(null, $branch->getOpeningSaturday());
        self::assertSame(null, $branch->getOpeningSunday());
        self::assertSame(null, $branch->getmaxWeight());
    }

    public function testStaticConstructorFallbackName(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'address' => 'address',
        ]);

        self::assertSame('zip', $branch->getName());
        self::assertSame('branch', $branch->getType());
        self::assertSame('address', $branch->getStreet());
    }

    public function testStaticConstructorStreetNumber(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'street' => 'street',
            'house_number' => '8',
            'orientation_number' => '896',
        ]);

        self::assertSame('street 8/896', $branch->getStreet());

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'street' => 'street',
            'house_number' => '8',
            'orientation_number' => '0',
        ]);

        self::assertSame('street 8', $branch->getStreet());

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'street' => 'street',
            'orientation_number' => '897',
        ]);

        self::assertSame('street 897', $branch->getStreet());

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'street' => 'street',
            'house_number' => '2',
        ]);

        self::assertSame('street 2', $branch->getStreet());

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'street' => 'street 1',
            'house_number' => '2',
            'orientation_number' => '3',
        ]);

        self::assertSame('street 1 2/3', $branch->getStreet());

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'address' => 'address',
            'house_number' => '2',
            'orientation_number' => '3',
        ]);

        self::assertSame('address', $branch->getStreet());

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'street' => '',
            'house_number' => '3',
            'orientation_number' => '4',
        ]);

        self::assertSame('3/4', $branch->getStreet());

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'city' => 'Vrbovec',
            'street' => '',
            'house_number' => '146',
            'orientation_number' => '0',
        ]);

        self::assertSame('Vrbovec 146', $branch->getStreet());

        $branch = $factory->create('cp', 'NP', [
            'zip' => 'zip',
            'city' => 'Vrbovec',
            'street' => '',
            'address' => 'address',
            'house_number' => '147',
            'orientation_number' => '0',
        ]);

        self::assertSame('Vrbovec 147', $branch->getStreet());
    }

    public function testBranchIdResolver(): void
    {
        $factory = $this->newDefaultBranchFactory();

        $branch = $factory->create('cp', 'NP', [
            'id' => 11,
            'name' => 'Branch Name',
            'zip' => '110 00',
        ]);

        self::assertSame('11000', $branch->getBranchId());

        $branch = $factory->create('sp', 'NP', [
            'id' => '11',
            'name' => 'Branch Name',
            'zip' => '110 00',
        ]);

        self::assertSame('11000', $branch->getBranchId());

        $branch = $factory->create('ulozenka', '7', [
            'id' => '11',
            'name' => 'Branch Name',
            'zip' => '110 00',
        ]);

        self::assertSame('11000', $branch->getBranchId());

        $branch = $factory->create('ppl', 'NP', [
            'id' => 'KM1234',
            'name' => 'Branch Name',
            'zip' => '110 00',
        ]);

        self::assertSame('1234', $branch->getBranchId());

        $branch = $factory->create('ppl', 'NP', [
            'id' => 'K1M234',
            'name' => 'Branch Name',
            'zip' => '110 00',
        ]);

        self::assertSame('K1M234', $branch->getBranchId());

        $branch = $factory->create('ppl', 'NP', [
            'id' => 'KMSKMK000000000',
            'name' => 'Branch Name',
            'zip' => '110 00',
        ]);

        self::assertSame('SKMK000000000', $branch->getBranchId());

        $branch = $factory->create('intime', 'NP', [
            'id' => '11',
            'name' => 'Branch Name',
            'zip' => '110 00',
        ]);

        self::assertSame('Branch Name', $branch->getBranchId());

        $branch = $factory->create('zasilkovna', null, [
            'id' => '167',
            'name' => 'Branch Name',
            'zip' => '110 00',
        ]);

        self::assertSame('167', $branch->getBranchId());
    }

    private function newDefaultBranchFactory(): BranchFactory
    {
        return new DefaultBranchFactory();
    }
}
