<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Model\Values\Country;
use function count;
use function is_string;

class GetCountriesDataMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $countries = $service->getCountriesData();

        self::assertTrue(count($countries) > 0);
        foreach ($countries as $id => $country) {
            self::assertInstanceOf(Country::class, $country);
            self::assertTrue($country->getCode() === $id);
            self::assertTrue(is_string($country->getName('cs')));
            self::assertTrue(is_string($country->getName('en')));
            self::assertTrue(is_string($country->getCurrencyCode()));
            self::assertTrue(is_string($country->getPhonePrefix()));
            self::assertTrue(is_string($country->getContinent()));
        }
    }
}
