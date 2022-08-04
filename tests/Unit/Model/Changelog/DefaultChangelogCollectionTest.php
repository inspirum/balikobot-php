<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Changelog;

use DateTimeImmutable;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelog;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogStatus;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogStatusCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultChangelogCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $items         = [
            new DefaultChangelog(
                '1.900',
                new DateTimeImmutable('2020-12-18'),
                new DefaultChangelogStatusCollection([
                    new DefaultChangelogStatus(
                        'ADD Zásilkovna',
                        '- delivery_costs a delivery_costs_eur - přidání GB',
                    ),
                    new DefaultChangelogStatus(
                        'ADD PbH',
                        '- content data - přidání GB',
                    ),
                ])
            ),
            new DefaultChangelog(
                '1.899',
                new DateTimeImmutable('2020-12-07'),
                new DefaultChangelogStatusCollection([
                    new DefaultChangelogStatus(
                        'ADD Gebrüder Weiss Česká republika',
                        '- nový atribut rec_floor_number - číslo patra',
                    ),
                ])
            ),
        ];
        $collection    = new DefaultChangelogCollection($items);
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

        self::assertSame($items, $collection->getChangelogs());
        self::assertSame('1.900', $collection->getLatestVersion());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
