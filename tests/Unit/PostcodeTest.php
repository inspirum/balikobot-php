<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

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

        $this->assertEquals('cp', $postcode->getShipper());
        $this->assertEquals('NP', $postcode->getService());
        $this->assertEquals('17000', $postcode->getPostcode());
        $this->assertEquals('18000', $postcode->getPostcodeEnd());
        $this->assertEquals('CZ', $postcode->getCountry());
        $this->assertEquals('Prague', $postcode->getCity());
        $this->assertTrue($postcode->isMorningDelivery());
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

        $this->assertEquals('cp', $postcode->getShipper());
        $this->assertEquals(null, $postcode->getService());
        $this->assertEquals('17000', $postcode->getPostcode());
        $this->assertEquals(null, $postcode->getPostcodeEnd());
        $this->assertEquals(null, $postcode->getCountry());
        $this->assertEquals(null, $postcode->getCity());
        $this->assertFalse($postcode->isMorningDelivery());
    }
}
