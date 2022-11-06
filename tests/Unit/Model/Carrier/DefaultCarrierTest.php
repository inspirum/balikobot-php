<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Carrier;

use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrier;
use Inspirum\Balikobot\Model\Method\DefaultMethod;
use Inspirum\Balikobot\Model\Method\DefaultMethodCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultCarrierTest extends BaseTestCase
{
    public function testModel(): void
    {
        $methods       = [
            'https://apiv2.balikobot.cz'    => new DefaultMethodCollection([
                new DefaultMethod('ADD'),
                new DefaultMethod('TRACKSTATUS'),
            ]),
            'https://apiv2.balikobot.cz/v2' => new DefaultMethodCollection([
                new DefaultMethod('ADD'),
                new DefaultMethod('DROP'),
            ]),
        ];
        $model         = new DefaultCarrier(
            'zasilkovna',
            'Zásilkovna',
            $methods,
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

        self::assertSame('zasilkovna', $model->getCode());
        self::assertSame('Zásilkovna', $model->getName());
        self::assertSame($methods, $model->getMethods());
        self::assertSame($methods[Version::V2V1], $model->getMethodsForVersion(Version::V2V1));
        self::assertSame($expectedArray, $model->__toArray());
    }
}
