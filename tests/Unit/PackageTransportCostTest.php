<?php

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Model\Values\PackageTransportCost;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class PackageTransportCostTest extends AbstractTestCase
{
    public function testStaticConstructor()
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

        $this->assertEquals('toptrans', $transportCost->getShipper());
        $this->assertEquals('8316699909', $transportCost->getBatchId());
        $this->assertEquals(2598.5, $transportCost->getTotalCost());
        $this->assertEquals('CZK', $transportCost->getCurrencyCode());
        $this->assertCount(5, $transportCost->getCostsBreakdown());
        $this->assertEquals('Avizace telefonem na vykládce: Ano', $transportCost->getCostsBreakdown()[3]->getName());
        $this->assertEquals(100, $transportCost->getCostsBreakdown()[2]->getCost());
    }

    public function testStaticConstructorWithMissingData()
    {
        $transportCost = PackageTransportCost::newInstanceFromData('toptrans', [
            'eid'         => '8316699909',
            'costs_total' => 2598.5,
            'currency'    => 'CZK',
        ]);

        $this->assertEquals('toptrans', $transportCost->getShipper());
        $this->assertEquals('8316699909', $transportCost->getBatchId());
        $this->assertEquals(2598.5, $transportCost->getTotalCost());
        $this->assertEquals('CZK', $transportCost->getCurrencyCode());
        $this->assertCount(0, $transportCost->getCostsBreakdown());
    }
}
