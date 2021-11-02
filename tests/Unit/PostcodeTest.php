<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Model\Values\PostCode;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class PostcodeTest extends AbstractTestCase
{
    public function testStaticConstructor(): void
    {
        $postcode = PostCode::newInstanceFromData(
            'cp',
            'NP',
            [
                'postcode'     => '17000',
                'postcode_end' => '18000',
                'city'         => 'Prague',
                'country'      => 'CZ',
                '1B'           => true,
            ]
        );

        self::assertEquals('cp', $postcode->getShipper());
        self::assertEquals('NP', $postcode->getService());
        self::assertEquals('17000', $postcode->getPostcode());
        self::assertEquals('18000', $postcode->getPostcodeEnd());
        self::assertEquals('CZ', $postcode->getCountry());
        self::assertEquals('Prague', $postcode->getCity());
        self::assertTrue($postcode->isMorningDelivery());
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $postcode = PostCode::newInstanceFromData(
            'cp',
            null,
            [
                'postcode' => '17000',
            ]
        );

        self::assertEquals('cp', $postcode->getShipper());
        self::assertEquals(null, $postcode->getService());
        self::assertEquals('17000', $postcode->getPostcode());
        self::assertEquals(null, $postcode->getPostcodeEnd());
        self::assertEquals(null, $postcode->getCountry());
        self::assertEquals(null, $postcode->getCity());
        self::assertFalse($postcode->isMorningDelivery());
    }
}
