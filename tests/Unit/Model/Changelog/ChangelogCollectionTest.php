<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Changelog;

use DateTimeImmutable;
use Inspirum\Balikobot\Model\Changelog\Changelog;
use Inspirum\Balikobot\Model\Changelog\ChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\ChangelogStatus;
use Inspirum\Balikobot\Model\Changelog\ChangelogStatusCollection;
use Inspirum\Balikobot\Tests\BaseTestCase;

final class ChangelogCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $collection    = new ChangelogCollection([
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
        $expectedArray = [
            [
                'code'    => '1.900',
                'date'    => '2020-12-18',
                'changes' => [
                    [
                        'name'        => 'ADD Zásilkovna',
                        'description' => '- delivery_costs a delivery_costs_eur - přidání GB',
                    ],
                    [
                        'name'        => 'ADD PbH',
                        'description' => '- content data - přidání GB',
                    ],
                ],
            ],
            [
                'code'    => '1.899',
                'date'    => '2020-12-07',
                'changes' => [
                    [
                        'name'        => 'ADD Gebrüder Weiss Česká republika',
                        'description' => '- nový atribut rec_floor_number - číslo patra',
                    ],
                ],
            ],
        ];

        self::assertSame('1.900', $collection->getLatestVersion());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
