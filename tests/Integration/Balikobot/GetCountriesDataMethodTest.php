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

        $this->assertTrue(count($countries) > 0);
        foreach ($countries as $id => $country) {
            $this->assertInstanceOf(Country::class, $country);
            $this->assertTrue($country->getCode() === $id);
            $this->assertTrue(is_string($country->getName('cs')));
            $this->assertTrue(is_string($country->getName('en')));
            $this->assertTrue(is_string($country->getCurrencyCode()));
            $this->assertTrue(is_string($country->getPhonePrefix()));
            $this->assertTrue(is_string($country->getContinent()));
        }
    }
}
