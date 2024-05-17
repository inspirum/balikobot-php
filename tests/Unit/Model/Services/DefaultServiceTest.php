<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Services;

use Inspirum\Balikobot\Model\Country\DefaultCodCountry;
use Inspirum\Balikobot\Model\Service\DefaultService;
use Inspirum\Balikobot\Model\Service\DefaultServiceOption;
use Inspirum\Balikobot\Model\Service\DefaultServiceOptionCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultServiceTest extends BaseTestCase
{
    public function testModel(): void
    {
        $countries = [
            'CZ',
            'EU',
        ];
        $options = new DefaultServiceOptionCollection([
            new DefaultServiceOption(
                '3',
                'Dodejka',
            ),
            new DefaultServiceOption(
                '4',
                'Dobírka Pk A/MZ dobírka',
            ),
        ]);
        $codCountries = [
            new DefaultCodCountry(
                'UA',
                'UAH',
                36000,
            ),
            new DefaultCodCountry(
                'LV',
                'USD',
                2000,
            ),
        ];
        $model = new DefaultService(
            'NP',
            'NP - Balík Na poštu',
            $options,
            $countries,
            $codCountries,
        );
        $expectedArray = [
            'type' => 'NP',
            'name' => 'NP - Balík Na poštu',
            'options' => [
                [
                    'code' => '3',
                    'name' => 'Dodejka',
                ],
                [
                    'code' => '4',
                    'name' => 'Dobírka Pk A/MZ dobírka',
                ],
            ],
            'countries' => [
                'CZ',
                'EU',
            ],
            'codCountries' => [
                [
                    'code' => 'UA',
                    'currencyCode' => 'UAH',
                    'maxPrice' => 36000.0,
                ],
                [
                    'code' => 'LV',
                    'currencyCode' => 'USD',
                    'maxPrice' => 2000.0,
                ],
            ],
        ];

        self::assertSame('NP', $model->getType());
        self::assertSame('NP - Balík Na poštu', $model->getName());
        self::assertSame($options, $model->getOptions());
        self::assertSame($countries, $model->getCountries());
        self::assertSame($codCountries, $model->getCodCountries());
        self::assertSame($expectedArray, $model->__toArray());
    }
}
