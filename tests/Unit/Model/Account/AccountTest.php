<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Account;

use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class AccountTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $model         = new Account(
            'Balikobot-Test_obchod.cz',
            'DPD_2',
            'info@balikobot.cz',
            '+420123456789',
            'http://www.balikobot_test2.cz',
            'Kovářská 12',
            'Praha 9',
            '19000',
            'CZ',
            false,
            new CarrierCollection([
                new Carrier(
                    'cp',
                    'Česká pošta',
                ),
                new Carrier(
                    'ppl',
                    'PPL',
                ),
                new Carrier(
                    'dpd',
                    'DPD',
                ),
            ])
        );
        $expectedArray = [
            'name'          => 'Balikobot-Test_obchod.cz',
            'contactPerson' => 'DPD_2',
            'email'         => 'info@balikobot.cz',
            'phone'         => '+420123456789',
            'url'           => 'http://www.balikobot_test2.cz',
            'street'        => 'Kovářská 12',
            'city'          => 'Praha 9',
            'zip'           => '19000',
            'country'       => 'CZ',
            'live'          => false,
            'carriers'      => [
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
                    'code'    => 'dpd',
                    'name'    => 'DPD',
                    'methods' => [],
                ],
            ],
        ];

        self::assertSame($expectedArray, $model->__toArray());
    }
}
