<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Model\Values\PackageTransportCost;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class PackageTransportCostTest extends AbstractTestCase
{
    public function testStaticConstructor(): void
    {
        $transportCost = PackageTransportCost::newInstanceFromData('toptrans', [
            'eid'             => '8316699909',
            'costs_total'     => 2598.5,
            'currency'        => 'CZK',
            'costs_breakdown' => [
                [
                    'name' => 'Base price',
                    'cost' => 1639,
                ],
                [
                    'name' => 'Nadrozměr: Nadrozměr - Ano',
                    'cost' => 819.5,
                ],
                [
                    'name' => 'Dobírka: Vnitrostátní',
                    'cost' => 100,
                ],
                [
                    'name' => 'Avizace telefonem na vykládce: Ano',
                    'cost' => 20,
                ],
                [
                    'name' => 'Avizace telefonem na nakládce: Ano',
                    'cost' => 20,
                ],
            ],
        ]);

        self::assertEquals('toptrans', $transportCost->getShipper());
        self::assertEquals('8316699909', $transportCost->getBatchId());
        self::assertEquals(2598.5, $transportCost->getTotalCost());
        self::assertEquals('CZK', $transportCost->getCurrencyCode());
        self::assertCount(5, $transportCost->getCostsBreakdown());
        self::assertEquals('Avizace telefonem na vykládce: Ano', $transportCost->getCostsBreakdown()[3]->getName());
        self::assertEquals(100, $transportCost->getCostsBreakdown()[2]->getCost());
        self::assertEquals('CZK', $transportCost->getCostsBreakdown()[0]->getCurrencyCode());
    }

    public function testStaticConstructorWithMissingData(): void
    {
        $transportCost = PackageTransportCost::newInstanceFromData('toptrans', [
            'eid'         => '8316699909',
            'costs_total' => 2598.5,
            'currency'    => 'CZK',
        ]);

        self::assertEquals('toptrans', $transportCost->getShipper());
        self::assertEquals('8316699909', $transportCost->getBatchId());
        self::assertEquals(2598.5, $transportCost->getTotalCost());
        self::assertEquals('CZK', $transportCost->getCurrencyCode());
        self::assertCount(0, $transportCost->getCostsBreakdown());
    }
}
