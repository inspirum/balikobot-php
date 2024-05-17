<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Changelog;

use Inspirum\Balikobot\Model\Changelog\DefaultChangelogStatus;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogStatusCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultChangelogStatusCollectionTest extends BaseTestCase
{
    public function testCollection(): void
    {
        $items = [
            new DefaultChangelogStatus(
                'ADD Zásilkovna',
                '- delivery_costs a delivery_costs_eur - přidání GB',
            ),
            new DefaultChangelogStatus(
                'ADD PbH',
                '- content data - přidání GB',
            ),
        ];
        $collection = new DefaultChangelogStatusCollection($items);
        $expectedArray = [
            [
                'name' => 'ADD Zásilkovna',
                'description' => '- delivery_costs a delivery_costs_eur - přidání GB',
            ],
            [
                'name' => 'ADD PbH',
                'description' => '- content data - přidání GB',
            ],
        ];

        self::assertSame($items, $collection->getStatuses());
        self::assertSame($expectedArray, $collection->__toArray());
    }
}
