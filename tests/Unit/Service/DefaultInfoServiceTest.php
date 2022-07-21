<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use DateTimeImmutable;
use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Definitions\CarrierType;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Account\AccountFactory;
use Inspirum\Balikobot\Model\Carrier\Carrier as CarrierModel;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Model\Carrier\CarrierFactory;
use Inspirum\Balikobot\Model\Changelog\Changelog;
use Inspirum\Balikobot\Model\Changelog\ChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\ChangelogFactory;
use Inspirum\Balikobot\Model\Changelog\ChangelogStatus;
use Inspirum\Balikobot\Model\Changelog\ChangelogStatusCollection;
use Inspirum\Balikobot\Model\Method\Method;
use Inspirum\Balikobot\Model\Method\MethodCollection;
use Inspirum\Balikobot\Service\DefaultInfoService;

final class DefaultInfoServiceTest extends BaseServiceTest
{
    public function testGetAccountInfo(): void
    {
        $response       = [
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
        ];
        $expectedResult = new Account(
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
                new CarrierModel(
                    'cp',
                    'Česká pošta',
                ),
                new CarrierModel(
                    'ppl',
                    'PPL',
                ),
                new CarrierModel(
                    'dpd',
                    'DPD',
                ),
            ])
        );

        $service = $this->newDefaultInfoService(
            client: $this->mockClient([VersionType::V2V1, null, Request::INFO_WHO_AM_I], $response),
            accountFactory: $this->mockAccountFactory($response, $expectedResult),
        );

        $actualResult = $service->getAccountInfo();

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCarriers(): void
    {
        $response       = [
            'status'   => 200,
            'carriers' => [
                [
                    'name'     => 'Česká pošta',
                    'slug'     => 'cp',
                    'endpoint' => 'https://api.balikobot.cz/cp',
                ],
                [
                    'name'     => 'PPL',
                    'slug'     => 'ppl',
                    'endpoint' => 'https://api.balikobot.cz/ppl',
                ],
                [
                    'name'     => 'Magyar Posta',
                    'slug'     => 'magyarposta',
                    'endpoint' => 'https://api.balikobot.cz/magyarposta',
                ],
            ],
        ];
        $expectedResult = new CarrierCollection([
            new CarrierModel(
                'cp',
                'Česká pošta',
            ),
            new CarrierModel(
                'ppl',
                'PPL',
            ),
            new CarrierModel(
                'magyarposta',
                'Magyar Posta',
            ),
        ]);

        $service = $this->newDefaultInfoService(
            client: $this->mockClient([VersionType::V2V1, null, Request::INFO_CARRIERS], $response),
            carrierFactory: $this->mockCarrierFactory(null, $response, $expectedResult),
        );

        $actualResult = $service->getCarriers();

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetCarrier(): void
    {
        $carrier        = CarrierType::ZASILKOVNA;
        $response       = [
            'status'               => 200,
            'name'                 => 'Zásilkovna',
            'v2_methods_available' => true,
            'methods'              => [
                [
                    'method'   => 'ADD',
                    'endpoint' => 'https://api.balikobot.cz/zasilkovna/add',
                ],
                [
                    'method'   => 'TRACKSTATUS',
                    'endpoint' => 'https://api.balikobot.cz/zasilkovna/trackstatus',
                ],
            ],
            'v2_methods'           => [
                [
                    'method'   => 'ADD',
                    'endpoint' => 'https://api.balikobot.cz/v2/zasilkovna/add',
                ],
                [
                    'method'   => 'DROP',
                    'endpoint' => 'https://api.balikobot.cz/v2/zasilkovna/drop',
                ],
            ],
        ];
        $expectedResult = new CarrierModel(
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

        $service = $this->newDefaultInfoService(
            client: $this->mockClient([VersionType::V2V1, null, Request::INFO_CARRIERS, [], $carrier->getValue()], $response),
            carrierFactory: $this->mockCarrierFactory($carrier, $response, $expectedResult),
        );

        $actualResult = $service->getCarrier($carrier);

        self::assertSame($expectedResult, $actualResult);
    }

    public function testGetChangelog(): void
    {
        $response       = [
            'status'                  => 200,
            'status_message'          => 'Operace proběhla v pořádku.',
            'api_v1_documentation_cz' => 'https://balikobot.docs.apiary.io/',
            'api_v2_documentation_cz' => 'https://balikobotv2.docs.apiary.io/',
            'api_v1_documentation_en' => 'https://balikoboteng.docs.apiary.io/',
            'api_v2_documentation_en' => 'https://balikobotv2eng.docs.apiary.io/',
            'version'                 => '1.900',
            'date'                    => '2020-12-18',
            'versions'                => [
                0 => [
                    'version' => '1.900',
                    'date'    => '2020-12-18',
                    'changes' => [
                        0 => [
                            'name'        => 'ADD Zásilkovna',
                            'description' => '- delivery_costs a delivery_costs_eur - přidání GB',
                        ],
                        1 => [
                            'name'        => 'ADD PbH',
                            'description' => '- content data - přidání GB',
                        ],
                    ],
                ],
                1 => [
                    'version' => '1.899',
                    'date'    => '2020-12-07',
                    'changes' => [
                        0 => [
                            'name'        => 'ADD Gebrüder Weiss Česká republika',
                            'description' => '- nový atribut rec_floor_number - číslo patra',
                        ],
                    ],
                ],
            ],
        ];
        $expectedResult = new ChangelogCollection([
            new Changelog(
                '1.900',
                new DateTimeImmutable('2020-12-18'),
                new ChangelogStatusCollection([
                    new ChangelogStatus(
                        'ADD Zásilkovna',
                        '- delivery_costs a delivery_costs_eur - přidání GB',
                    ),
                    new ChangelogStatus(
                        'ADD PbH',
                        '- content data - přidání GB',
                    ),
                ])
            ),
            new Changelog(
                '1.899',
                new DateTimeImmutable('2020-12-07'),
                new ChangelogStatusCollection([
                    new ChangelogStatus(
                        'ADD Gebrüder Weiss Česká republika',
                        '- nový atribut rec_floor_number - číslo patra',
                    ),
                ])
            ),
        ]);

        $service = $this->newDefaultInfoService(
            client: $this->mockClient([VersionType::V2V1, null, Request::CHANGELOG], $response),
            changelogFactory: $this->mockChangelogFactory($response, $expectedResult),
        );

        $actualResult = $service->getChangelog();

        self::assertSame($expectedResult, $actualResult);
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockAccountFactory(array $data, Account $response): AccountFactory
    {
        $serviceFactory = $this->createMock(AccountFactory::class);
        $serviceFactory->expects(self::once())->method('create')->with($data)->willReturn($response);

        return $serviceFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockCarrierFactory(?Carrier $carrier, array $data, CarrierCollection|CarrierModel $response): CarrierFactory
    {
        $serviceFactory = $this->createMock(CarrierFactory::class);
        $serviceFactory->expects(self::once())
                       ->method($response instanceof CarrierModel ? 'create' : 'createCollection')
                       ->with(...($response instanceof CarrierModel ? [$carrier, $data] : [$data]))
                       ->willReturn($response);

        return $serviceFactory;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function mockChangelogFactory(array $data, ChangelogCollection $response): ChangelogFactory
    {
        $serviceFactory = $this->createMock(ChangelogFactory::class);
        $serviceFactory->expects(self::once())->method('createCollection')->with($data)->willReturn($response);

        return $serviceFactory;
    }

    private function newDefaultInfoService(
        Client $client,
        ?AccountFactory $accountFactory = null,
        ?CarrierFactory $carrierFactory = null,
        ?ChangelogFactory $changelogFactory = null,
    ): DefaultInfoService {
        return new DefaultInfoService(
            $client,
            $accountFactory ?? $this->createMock(AccountFactory::class),
            $carrierFactory ?? $this->createMock(CarrierFactory::class),
            $changelogFactory ?? $this->createMock(ChangelogFactory::class),
        );
    }
}
