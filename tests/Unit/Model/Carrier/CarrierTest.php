<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Carrier;

use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class CarrierTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $collection    = new CarrierCollection([
            new Carrier(
                'cp',
                'Česká pošta',
            ),
            new Carrier(
                'ppl',
                'PPL',
            ),
            new Carrier(
                'magyarposta',
                'Magyar Posta',
            ),
        ]);
        $expectedArray = [
            [
                'code'    => 'cp',
                'name'    => 'Česká pošta',
                'methods' => [],
            ],
            [
                'code'    => 'ppl',
                'name'    => 'PPL',
                'methods' => [],
            ],
            [
                'code'    => 'magyarposta',
                'name'    => 'Magyar Posta',
                'methods' => [],
            ],
        ];

        self::assertSame($expectedArray, $collection->__toArray());
    }
}
