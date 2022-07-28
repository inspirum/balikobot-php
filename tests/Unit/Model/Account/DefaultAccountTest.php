<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Account;

use Inspirum\Balikobot\Model\Account\DefaultAccount;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrier;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultAccountTest extends BaseTestCase
{
    public function testModel(): void
    {
        $carriers      = new DefaultCarrierCollection([
            new DefaultCarrier(
                'cp',
                'Česká pošta',
            ),
            new DefaultCarrier(
                'ppl',
                'PPL',
            ),
            new DefaultCarrier(
                'dpd',
                'DPD',
            ),
        ]);
        $model         = new DefaultAccount(
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
            $carriers,
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

        self::assertSame('Balikobot-Test_obchod.cz', $model->getName());
        self::assertSame('DPD_2', $model->getContactPerson());
        self::assertSame('info@balikobot.cz', $model->getEmail());
        self::assertSame('+420123456789', $model->getPhone());
        self::assertSame('http://www.balikobot_test2.cz', $model->getUrl());
        self::assertSame('Kovářská 12', $model->getStreet());
        self::assertSame('Praha 9', $model->getCity());
        self::assertSame('19000', $model->getZipCode());
        self::assertSame('CZ', $model->getCountry());
        self::assertSame(false, $model->isLive());
        self::assertSame($carriers, $model->getCarriers());
        self::assertSame($expectedArray, $model->__toArray());
    }
}
