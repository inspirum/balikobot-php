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

        self::assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('zasilkovna', null);

        self::assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('zasilkovna', 'VMCZ');

        self::assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('pbh', '6');

        self::assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('pbh', '15');

        self::assertTrue($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('cp', 'RR');

        self::assertFalse($fullBranchesSupport);

        $fullBranchesSupport = Shipper::hasFullBranchesSupport('ulozenka', null);

        self::assertFalse($fullBranchesSupport);
    }
}
