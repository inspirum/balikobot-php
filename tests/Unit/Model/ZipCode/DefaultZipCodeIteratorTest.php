<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ZipCode;

use ArrayIterator;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Model\ZipCode\DefaultZipCode;
use Inspirum\Balikobot\Model\ZipCode\DefaultZipCodeIterator;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use function iterator_to_array;

final class DefaultZipCodeIteratorTest extends BaseTestCase
{
    public function testIterator(): void
    {
        $carrier = Carrier::CP;
        $service = Service::CP_NP;
        $items   = [
            new DefaultZipCode(
                $carrier,
                $service,
                '35002',
                null,
                'Praha',
                'CZ',
                false,
            ),
            new DefaultZipCode(
                $carrier,
                $service,
                '36002',
                null,
                'Praha',
                'CZ',
                false,
            ),
        ];

        $iterator = new DefaultZipCodeIterator($carrier, $service, new ArrayIterator($items));

        self::assertSame($items, iterator_to_array($iterator));
        self::assertSame($carrier, $iterator->getCarrier());
        self::assertSame($service, $iterator->getService());
    }
}
