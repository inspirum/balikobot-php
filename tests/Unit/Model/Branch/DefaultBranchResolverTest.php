<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Branch;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Model\Branch\DefaultBranchResolver;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class DefaultBranchResolverTest extends BaseTestCase
{
    #[DataProvider('providesTestHasFullBranchesSupport')]
    public function testHasFullBranchesSupport(string $carrier, ?string $service, bool $result): void
    {
        $resolver = $this->newDefaultBranchResolver();

        $supports = $resolver->hasFullBranchesSupport($carrier, $service);

        self::assertSame($result, $supports);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public static function providesTestHasFullBranchesSupport(): iterable
    {
        yield 'zasilkovna' => [
            'carrier' => Carrier::ZASILKOVNA,
            'service' => null,
            'result'  => true,
        ];

        yield 'zasilkovna_vmcz' => [
            'carrier' => Carrier::ZASILKOVNA,
            'service' => Service::ZASILKOVNA_VMCZ,
            'result'  => true,
        ];

        yield 'cp_np' => [
            'carrier' => Carrier::CP,
            'service' => Service::CP_NP,
            'result'  => true,
        ];

        yield 'cp_null' => [
            'carrier' => Carrier::CP,
            'service' => null,
            'result'  => false,
        ];

        yield 'cp_nb' => [
            'carrier' => Carrier::CP,
            'service' => Service::CP_NB,
            'result'  => true,
        ];

        yield 'pbh_mp' => [
            'carrier' => Carrier::PBH,
            'service' => Service::PBH_MP,
            'result'  => true,
        ];

        yield 'pbh_fan_kurier' => [
            'carrier' => Carrier::PBH,
            'service' => Service::PBH_FAN_KURIER,
            'result'  => true,
        ];

        yield 'pbh_null' => [
            'carrier' => Carrier::PBH,
            'service' => null,
            'result'  => false,
        ];

        yield 'pbh_cargus' => [
            'carrier' => Carrier::PBH,
            'service' => Service::PBH_CARGUS,
            'result'  => false,
        ];
    }

    #[DataProvider('providesTestHasBranchCountryFilterSupport')]
    public function testHasBranchCountryFilterSupport(string $carrier, ?string $service, bool $result): void
    {
        $resolver = $this->newDefaultBranchResolver();

        $supports = $resolver->hasBranchCountryFilterSupport($carrier, $service);

        self::assertSame($result, $supports);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public static function providesTestHasBranchCountryFilterSupport(): iterable
    {
        yield 'ppl' => [
            'carrier' => Carrier::PPL,
            'service' => Service::PPL_PARCEL_BUSSINESS_CZ,
            'result'  => true,
        ];

        yield 'dpd' => [
            'carrier' => Carrier::DPD,
            'service' => Service::DPD_CLASSIC,
            'result'  => true,
        ];

        yield 'gls' => [
            'carrier' => Carrier::GLS,
            'service' => Service::GLS_SHOP,
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
