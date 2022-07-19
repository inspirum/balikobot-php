<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service;

use DateTimeImmutable;
use Inspirum\Balikobot\Client\DefaultClient;
use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Model\Account\Account;
use Inspirum\Balikobot\Model\Account\DefaultAccountFactory;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierFactory;
use Inspirum\Balikobot\Model\Changelog\Changelog;
use Inspirum\Balikobot\Model\Changelog\ChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\ChangelogStatus;
use Inspirum\Balikobot\Model\Changelog\ChangelogStatusCollection;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogFactory;
use Inspirum\Balikobot\Model\Method\DefaultMethodFactory;
use Inspirum\Balikobot\Model\Method\Method;
use Inspirum\Balikobot\Model\Method\MethodCollection;
use Inspirum\Balikobot\Service\DefaultInfoService;
use Inspirum\Balikobot\Service\InfoService;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;

final class DefaultInfoServiceTest extends BaseTestCase
{
    /**
     * @param array<mixed,mixed>      $response
     * @param array<string>           $carrierIds
     * @param array<mixed,mixed>|null $request
     *
     * @dataProvider providesTestAccountInfo
     */
    public function testAccountInfo(
        int $statusCode,
        array $response,
        Account|Throwable|null $result,
        ?array $request = null,
    ): void {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $service = $this->newInfoService($statusCode, $response, $request);

        $res = $service->getAccountInfo();

        if ($result !== null) {
            self::assertEquals($result, $res);
        }
    }

    /**
     * @return iterable<array<mixed,mixed>>
     */
    public function providesTestAccountInfo(): iterable
    {
        yield 'response_without_status' => [
            'statusCode' => 200,
            'response'   => [
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
            'result'     => new BadRequestException([], 500),
            'request'    => null,
        ];

        yield 'valid_request' => [
            'statusCode' => 200,
            'response'   => [
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
            'request'    => [
                'https://apiv2.balikobot.cz/info/whoami',
            ],
        ];
    }

    /**
     * @param array<mixed,mixed>      $response
     * @param array<string>           $carrierIds
     * @param array<mixed,mixed>|null $request
     *
     * @dataProvider providesTestGetCarriers
     */
    public function testGetCarriers(
        int $statusCode,
        array $response,
        CarrierCollection|Throwable|null $result,
        ?array $request = null,
    ): void {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $service = $this->newInfoService($statusCode, $response, $request);

        $res = $service->getCarriers();

        if ($result !== null) {
            self::assertEquals($result, $res);
        }
    }

    /**
     * @return iterable<array<mixed,mixed>>
     */
    public function providesTestGetCarriers(): iterable
    {
        yield 'response_without_status' => [
            'statusCode' => 200,
            'response'   => [
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
            ],
            'result'     => new BadRequestException([], 500),
            'request'    => null,
        ];

        yield 'valid_request' => [
            'statusCode' => 200,
            'response'   => [
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
            ],
            'result'     => new CarrierCollection([
                new Carrier(
                    'cp',
                    'Česká pošta',
                ),
                new Carrier(
                    'ppl',
                    'PPL',
                ),
                new Carrier(
                    'magyarposta',
                    'Magyar Posta',
                ),
            ]),
            'request'    => [
                'https://apiv2.balikobot.cz/info/carriers',
            ],
        ];
    }

    /**
     * @param array<mixed,mixed>      $response
     * @param array<string>           $carrierIds
     * @param array<mixed,mixed>|null $request
     *
     * @dataProvider providesTestGetCarrier
     */
    public function testGetCarrier(
        int $statusCode,
        CarrierType $carrier,
        array $response,
        Carrier|Throwable|null $result,
        ?array $request = null,
    ): void {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $service = $this->newInfoService($statusCode, $response, $request);

        $res = $service->getCarrier($carrier);

        if ($result !== null) {
            self::assertEquals($result, $res);
        }
    }

    /**
     * @return iterable<array<mixed,mixed>>
     */
    public function providesTestGetCarrier(): iterable
    {
        yield 'response_without_status' => [
            'statusCode' => 200,
            'carrier'    => \Inspirum\Balikobot\Definitions\Carrier::ZASILKOVNA,
            'response'   => [
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
            ],
            'result'     => new BadRequestException([], 500),
            'request'    => null,
        ];

        yield 'valid_request' => [
            'statusCode' => 200,
            'carrier'    => \Inspirum\Balikobot\Definitions\Carrier::ZASILKOVNA,
            'response'   => [
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
            ],
            'result'     => new Carrier(
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
            ),
            'request'    => [
                'https://apiv2.balikobot.cz/info/carriers/zasilkovna',
            ],
        ];
    }

    /**
     * @param array<mixed,mixed>      $response
     * @param array<string>           $carrierIds
     * @param array<mixed,mixed>|null $request
     *
     * @dataProvider providesTestGetChangelog
     */
    public function testGetChangelog(
        int $statusCode,
        array $response,
        ChangelogCollection|Throwable|null $result,
        ?array $request = null,
    ): void {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $service = $this->newInfoService($statusCode, $response, $request);

        $res = $service->getChangelog();

        if ($result !== null) {
            self::assertEquals($result, $res);
        }
    }

    /**
     * @return iterable<array<mixed,mixed>>
     */
    public function providesTestGetChangelog(): iterable
    {
        yield 'response_without_status' => [
            'statusCode' => 200,
            'response'   => [
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
                ],
            ],
            'result'     => new BadRequestException([], 500),
            'request'    => null,
        ];

        yield 'valid_request' => [
            'statusCode' => 200,
            'response'   => [
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
            ],
            'result'     => new ChangelogCollection([
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
            ]),
            'request'    => [
                'https://apiv2.balikobot.cz/changelog',
            ],
        ];
    }

    /**
     * @param array<mixed,mixed>|string $response
     * @param array<mixed,mixed>|null   $request
     */
    private function newInfoService(int $statusCode, array|string $response, ?array $request = null): InfoService
    {
        $requester        = $this->newRequester($statusCode, $response, $request);
        $validator        = new Validator();
        $client           = new DefaultClient($requester, $validator);
        $methodFactory    = new DefaultMethodFactory();
        $carrierFactory   = new DefaultCarrierFactory($methodFactory);
        $accountFactory   = new DefaultAccountFactory($carrierFactory);
        $changelogFactory = new DefaultChangelogFactory();

        return new DefaultInfoService($client, $accountFactory, $carrierFactory, $changelogFactory);
    }
}
