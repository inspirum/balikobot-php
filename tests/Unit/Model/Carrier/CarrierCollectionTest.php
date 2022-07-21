<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Carrier;

use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Method\Method;
use Inspirum\Balikobot\Model\Method\MethodCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class CarrierCollectionTest extends BaseTestCase
{
    public function testModel(): void
    {
        $model         = new Carrier(
            'zasilkovna',
            'Zásilkovna',
            [
                'https://apiv2.balikobot.cz'    => new MethodCollection([
                    new Method('ADD'),
                    new Method('TRACKSTATUS'),
                ]),
                'https://apiv2.balikobot.cz/v2' => new MethodCollection([
                    new Method('ADD'),
                    new Method('DROP'),
                ]),
            ]
        );
        $expectedArray = [
            'code'    => 'zasilkovna',
            'name'    => 'Zásilkovna',
            'methods' => [
                'https://apiv2.balikobot.cz'    => [
                    [
                        'code' => 'ADD',
                    ],
                    [
                        'code' => 'TRACKSTATUS',
                    ],
                ],
                'https://apiv2.balikobot.cz/v2' => [
                    [
                        'code' => 'ADD',
                    ],
                    [
                        'code' => 'DROP',
                    ],
                ],
            ],
        ];

        self::assertSame($expectedArray, $model->__toArray());
        self::assertSame([
            [
                'code' => 'ADD',
            ],
            [
                'code' => 'TRACKSTATUS',
            ],
        ], $model->getMethods(VersionType::V2V1));
    }
}
