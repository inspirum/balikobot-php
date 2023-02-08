<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Account;

use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Account\DefaultAccount;
use Inspirum\Balikobot\Model\Account\DefaultAccountFactory;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrier;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierCollection;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierFactory;
use Inspirum\Balikobot\Model\Method\DefaultMethodFactory;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Throwable;

final class DefaultAccountFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestCreate')]
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
    public static function providesTestCreate(): iterable
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
            'result'     => new DefaultAccount(
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
                new DefaultCarrierCollection([
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
                ]),
            ),
        ];
    }

    private function newDefaultAccountFactory(): DefaultAccountFactory
    {
        return new DefaultAccountFactory(new DefaultCarrierFactory(new DefaultMethodFactory()));
    }
}
