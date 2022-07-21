<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Status;

use DateTimeImmutable;
use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Model\Carrier\Carrier;
use Inspirum\Balikobot\Model\Status\DefaultStatusFactory;
use Inspirum\Balikobot\Model\Status\Status;
use Inspirum\Balikobot\Model\Status\StatusFactory;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultStatusFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateFromStatusData
     */
    public function testCreateFromStatusData(Carrier $carrier, string $carrierId, array $data, Status $expectedStatus): void
    {
        $factory = $this->newDefaultPackageStatusFactory();

        $status = $factory->create($carrier, $carrierId, $data);

        self::assertEquals($expectedStatus, $status);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateFromStatusData(): iterable
    {
        yield 'v2' => [
            'carrier' => Carrier::from('cp'),
            'carrierId' => '1',
            'data'   => [
                'date'          => '2018-11-07 14:15:01',
                'name'          => 'Doručení',
                'name_internal' => 'Zásilka byla doručena příjemci.',
                'status_id'     => 2.1,
                'type'          => 'notification',
            ],
            'status' => new Status(Carrier::from('cp'), '1', 2.1, 'Zásilka byla doručena příjemci.', 'Doručení', 'notification', new DateTimeImmutable('2018-11-07 14:15:01')),
        ];

        yield 'missing_data' => [
            'carrier' => Carrier::from('cp'),
            'carrierId' => '2',
            'data'   => [
                'name'      => 'Doručení',
                'status_id' => 2,
            ],
            'status' => new Status(Carrier::from('cp'), '2', 2.0, 'Doručení', 'Doručení', 'event', null),
        ];

        yield 'v3' => [
            'carrier' => Carrier::from('cp'),
            'carrierId' => '3',
            'data'   => [
                'date'           => '2018-11-08 14:18:01',
                'name'           => 'Doručení',
                'name_balikobot' => 'Zásilka byla doručena příjemci.',
                'status_id'      => 2,
                'status_id_v2'   => 2.3,
                'type'           => 'event',
            ],
            'status' => new Status(Carrier::from('cp'), '3', 2.3, 'Zásilka byla doručena příjemci.', 'Doručení', 'event', new DateTimeImmutable('2018-11-08 14:18:01')),
        ];
    }

    private function newDefaultPackageStatusFactory(): StatusFactory
    {
        $validator = new Validator();

        return new DefaultStatusFactory($validator);
    }
}
