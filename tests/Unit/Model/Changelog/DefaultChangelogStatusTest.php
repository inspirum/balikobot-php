<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Changelog;

use Inspirum\Balikobot\Model\Changelog\DefaultChangelogStatus;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultChangelogStatusTest extends BaseTestCase
{
    public function testModel(): void
    {
        $model         = new DefaultChangelogStatus(
            'ADD Zásilkovna',
            '- delivery_costs a delivery_costs_eur - přidání GB',
        );
        $expectedArray = [
            'name'        => 'ADD Zásilkovna',
            'description' => '- delivery_costs a delivery_costs_eur - přidání GB',
        ];

        self::assertSame('ADD Zásilkovna', $model->getName());
        self::assertSame('- delivery_costs a delivery_costs_eur - přidání GB', $model->getDescription());
        self::assertSame($expectedArray, $model->__toArray());
    }
}
