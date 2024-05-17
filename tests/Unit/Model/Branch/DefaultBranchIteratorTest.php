<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Branch;

use ArrayIterator;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Model\Branch\DefaultBranch;
use Inspirum\Balikobot\Model\Branch\DefaultBranchIterator;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use function iterator_to_array;

final class DefaultBranchIteratorTest extends BaseTestCase
{
    public function testIterator(): void
    {
        $carrier = Carrier::CP;
        $service = Service::CP_NP;
        $countries = [
            Country::CZECH_REPUBLIC,
            Country::HUNGARY,
        ];
        $items = [
            new DefaultBranch(
                Carrier::CP,
                Service::CP_NP,
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
                Service::CP_NP,
                '12000',
                '1235',
                null,
                'type2',
                'name2',
                'city2',
                'street 27/9',
                '12000',
            ),
        ];

        $iterator = new DefaultBranchIterator($carrier, $service, $countries, new ArrayIterator($items));

        self::assertSame($items, iterator_to_array($iterator));
        self::assertSame($carrier, $iterator->getCarrier());
        self::assertSame($service, $iterator->getService());
        self::assertSame($countries, $iterator->getCountries());
    }
}
