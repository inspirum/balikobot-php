<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use DateTimeImmutable;
use Inspirum\Balikobot\Model\DefaultPackageStatusFactory;
use Inspirum\Balikobot\Model\PackageStatus;
use Inspirum\Balikobot\Model\PackageStatusFactory;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class DefaultPackageStatusFactoryTest extends BaseTestCase
{
    /**
     * @param array<string, mixed> $data
     *
     * @dataProvider providesTestCreateFromStatusData
     */
    public function testCreateFromStatusData(array $data, PackageStatus $expectedStatus): void
    {
        $factory = $this->newDefaultPackageStatusFactory();

        $status = $factory->createFromStatusData($data);

        self::assertEquals($expectedStatus, $status);
    }

    /**
     * @return iterable<array<string, mixed>>
     */
    public function providesTestCreateFromStatusData(): iterable
    {
        yield 'v2' => [
            'data'   => [
                'date'          => '2018-11-07 14:15:01',
                'name'          => 'Doručení',
                'name_internal' => 'Zásilka byla doručena příjemci.',
                'status_id'     => 2.1,
                'type'          => 'notification',
            ],
            'status' => new PackageStatus(2.1, 'Zásilka byla doručena příjemci.', 'Doručení', 'notification', new DateTimeImmutable('2018-11-07 14:15:01')),
        ];

        yield 'missing_data' => [
            'data'   => [
                'name'      => 'Doručení',
                'status_id' => 2,
            ],
            'status' => new PackageStatus(2.0, 'Doručení', 'Doručení', 'event', null),
        ];

        yield 'v3' => [
            'data'   => [
                'date'           => '2018-11-08 14:18:01',
                'name'           => 'Doručení',
                'name_balikobot' => 'Zásilka byla doručena příjemci.',
                'status_id'      => 2,
                'status_id_v2'   => 2.3,
                'type'           => 'event',
            ],
            'status' => new PackageStatus(2.3, 'Zásilka byla doručena příjemci.', 'Doručení', 'event', new DateTimeImmutable('2018-11-08 14:18:01')),
        ];
    }

    private function newDefaultPackageStatusFactory(): PackageStatusFactory
    {
        return new DefaultPackageStatusFactory();
    }
}
