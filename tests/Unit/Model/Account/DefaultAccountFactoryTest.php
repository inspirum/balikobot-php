<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Account;

use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Account\DefaultAccountFactory;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierFactory;
use Inspirum\Balikobot\Model\Method\DefaultMethodFactory;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultAccountFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreate
     */
    public function testCreate(array $data, Account|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultAccountFactory();

        $collection = $factory->create($data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreate(): iterable
    {
        yield 'valid' => [
            'data'    => [
                'status'       => 200,
                'account'      => [
                    'name'           => 'Balikobot-Test_obchod.cz',
                    'contact_person' => 'DPD_2',
                    'street'         => 'Kovářská 12',
                    'city'           => 'Praha 9',
                    'zip'            => '19000',
                    'country'        => 'CZ',
                    'email'          => 'info@balikobot.cz',
                    'url'            => 'http://www.balikobot_test2.cz',
                    'phone'          => '+420123456789',
                ],
                'live_account' => false,
                'carriers'     => [
                    [
                        'name' => 'Česká pošta',
                        'slug' => 'cp',
                    ],
                    [
                        'name' => 'PPL',
                        'slug' => 'ppl',
                    ],
                    [
                        'name' => 'DPD',
                        'slug' => 'dpd',
                    ],
                ],
            ],
            'result'     => new Account(
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
            ),
        ];
    }

    private function newDefaultAccountFactory(): DefaultAccountFactory
    {
        return new DefaultAccountFactory(new DefaultCarrierFactory(new DefaultMethodFactory()));
    }
}
