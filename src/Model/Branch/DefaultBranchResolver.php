<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\ServiceType;
use function in_array;

final class DefaultBranchResolver implements BranchResolver
{
    public function hasFullBranchesSupport(string $carrier, ?string $service): bool
    {
        return $carrier === Carrier::ZASILKOVNA
            || ($carrier === Carrier::CP && $service === ServiceType::CP_NP)
            || ($carrier === Carrier::PBH && in_array($service, [ServiceType::PBH_MP, ServiceType::PBH_FAN_KURIER]));
    }

    public function hasBranchCountryFilterSupport(string $carrier, ?string $service): bool
    {
        if ($service === null) {
            return true;
        }

        $supportedShippers = [
            Carrier::PPL,
            Carrier::DPD,
            Carrier::GLS,
        ];

        return in_array($carrier, $supportedShippers);
    }
}
