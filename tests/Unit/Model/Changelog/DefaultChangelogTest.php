<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Changelog;

use DateTimeImmutable;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelog;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogStatus;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogStatusCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultChangelogTest extends BaseTestCase
{
    public function testModel(): void
    {
        $date = new DateTimeImmutable('2020-12-18');
        $changes = new DefaultChangelogStatusCollection([
            new DefaultChangelogStatus(
                'ADD Zásilkovna',
                '- delivery_costs a delivery_costs_eur - přidání GB',
            ),
            new DefaultChangelogStatus(
                'ADD PbH',
                '- content data - přidání GB',
            ),
        ]);
        $model = new DefaultChangelog(
            '1.900',
            $date,
            $changes,
        );
        $expectedArray = [
            'code' => '1.900',
            'date' => '2020-12-18',
            'changes' => [
                [
                    'name' => 'ADD Zásilkovna',
                    'description' => '- delivery_costs a delivery_costs_eur - přidání GB',
                ],
                [
                    'name' => 'ADD PbH',
                    'description' => '- content data - přidání GB',
                ],
            ],
        ];

        self::assertSame('1.900', $model->getVersion());
        self::assertSame($date, $model->getDate());
        self::assertSame($changes, $model->getChanges());
        self::assertSame($expectedArray, $model->__toArray());
    }
}
