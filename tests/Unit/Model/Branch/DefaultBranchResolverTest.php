<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Branch;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\ServiceType;
use Inspirum\Balikobot\Model\Branch\DefaultBranchResolver;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultBranchResolverTest extends BaseTestCase
{
    /**
     * @dataProvider providesTestHasFullBranchesSupport
     */
    public function testHasFullBranchesSupport(string $carrier, ?string $service, bool $result): void
    {
        $resolver = $this->newDefaultBranchResolver();

        $supports = $resolver->hasFullBranchesSupport($carrier, $service);

        self::assertSame($result, $supports);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestHasFullBranchesSupport(): iterable
    {
        yield 'zasilkovna' => [
            'carrier' => Carrier::ZASILKOVNA,
            'service' => null,
            'result'  => true,
        ];

        yield 'zasilkovna_vmcz' => [
            'carrier' => Carrier::ZASILKOVNA,
            'service' => ServiceType::ZASILKOVNA_VMCZ,
            'result'  => true,
        ];

        yield 'cp_np' => [
            'carrier' => Carrier::CP,
            'service' => ServiceType::CP_NP,
            'result'  => true,
        ];

        yield 'cp_null' => [
            'carrier' => Carrier::CP,
            'service' => null,
            'result'  => false,
        ];

        yield 'cp_nb' => [
            'carrier' => Carrier::CP,
            'service' => ServiceType::CP_NB,
            'result'  => true,
        ];

        yield 'pbh_mp' => [
            'carrier' => Carrier::PBH,
            'service' => ServiceType::PBH_MP,
            'result'  => true,
        ];

        yield 'pbh_fan_kurier' => [
            'carrier' => Carrier::PBH,
            'service' => ServiceType::PBH_FAN_KURIER,
            'result'  => true,
        ];

        yield 'pbh_null' => [
            'carrier' => Carrier::PBH,
            'service' => null,
            'result'  => false,
        ];

        yield 'pbh_cargus' => [
            'carrier' => Carrier::PBH,
            'service' => ServiceType::PBH_CARGUS,
            'result'  => false,
        ];
    }

    /**
     * @dataProvider providesTestHasBranchCountryFilterSupport
     */
    public function testHasBranchCountryFilterSupport(string $carrier, ?string $service, bool $result): void
    {
        $resolver = $this->newDefaultBranchResolver();

        $supports = $resolver->hasBranchCountryFilterSupport($carrier, $service);

        self::assertSame($result, $supports);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestHasBranchCountryFilterSupport(): iterable
    {
        yield 'ppl' => [
            'carrier' => Carrier::PPL,
            'service' => ServiceType::PPL_PARCEL_BUSSINESS_CZ,
            'result'  => true,
        ];

        yield 'dpd' => [
            'carrier' => Carrier::DPD,
            'service' => ServiceType::DPD_CLASSIC,
            'result'  => true,
        ];

        yield 'gls' => [
            'carrier' => Carrier::GLS,
            'service' => ServiceType::GLS_SHOP,
            'result'  => true,
        ];

        yield 'zasilkovna' => [
            'carrier' => Carrier::ZASILKOVNA,
            'service' => null,
            'result'  => true,
        ];
    }

    private function newDefaultBranchResolver(): DefaultBranchResolver
    {
        return new DefaultBranchResolver();
    }
}
