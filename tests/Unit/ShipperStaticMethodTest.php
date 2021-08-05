<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Definitions\Shipper;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class ShipperStaticMethodTest extends AbstractTestCase
{
    public function testFullBranchesSupport(): void
    {
        $fullBranchesSupport = Shipper::hasFullBranchesSupport('cp', 'NP');

        $this->assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('zasilkovna', null);

        $this->assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('zasilkovna', 'VMCZ');

        $this->assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('pbh', '6');

        $this->assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('pbh', '15');

        $this->assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('cp', 'RR');

        $this->assertFalse($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('ulozenka', null);

        $this->assertFalse($fullBranchesSupport);
    }
}
