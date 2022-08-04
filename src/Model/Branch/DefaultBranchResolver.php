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
        $supported = [
            Carrier::ZASILKOVNA => null,
            Carrier::CP         => [
                ServiceType::CP_NP,
                ServiceType::CP_NB,
            ],
            Carrier::PBH        => [
                ServiceType::PBH_UPS,
                ServiceType::PBH_SP,
                ServiceType::PBH_MP,
                ServiceType::PBH_RP,
                ServiceType::PBH_CP_NP,
                ServiceType::PBH_INPOST_KURIER,
                ServiceType::PBH_FAN_KURIER,
                ServiceType::PBH_SPEEDY,
                ServiceType::PBH_NOBA_POSHTA,
                ServiceType::PBH_ECONT,
            ],
            Carrier::DPD        => [
                ServiceType::DPD_PICKUP,
            ],
            Carrier::GLS        => [
                ServiceType::GLS_SHOP,
                ServiceType::GLS_GUARANTEED24_SHOP,
            ],
            Carrier::INTIME     => [
                ServiceType::INTIME_POSTOMAT_CZ,
                ServiceType::INTIME_BOX_CZ,
                ServiceType::INTIME_BOX_SK,
            ],
            Carrier::SPS        => [
                ServiceType::SPS_EXPRESS,
                ServiceType::SPS_INTERNATIONAL,
            ],
            Carrier::SP         => [
                ServiceType::SP_BZP,
                ServiceType::SP_BZB,
                ServiceType::SP_EXP,
                ServiceType::SP_EXB,
                ServiceType::SP_BNP,
                ServiceType::SP_BNB,
            ],
            Carrier::ULOZENKA   => [
                ServiceType::ULOZENKA_ULOZENKA,
                ServiceType::ULOZENKA_DPD_PARCEL,
                ServiceType::ULOZENKA_CP_NP,
                ServiceType::ULOZENKA_PARTNER,
                ServiceType::ULOZENKA_EXPRESS_SK,
                ServiceType::ULOZENKA_BALIKOBOX_SK,
                ServiceType::ULOZENKA_DEPO_SK,
            ],
            Carrier::PPL        => [
                ServiceType::PPL_CONNECT,
                ServiceType::PPL_PRIVATE,
                ServiceType::PPL_PRIVATE_SMART_CZ,
                ServiceType::PPL_PRIVATE_SMART_EU,
            ],
        ];

        foreach ($supported as $supportedCarrier => $supportedServices) {
            if ($carrier === $supportedCarrier && ($supportedServices === null || in_array($service, $supportedServices, true))) {
                return true;
            }
        }

        return false;
    }

    public function hasBranchCountryFilterSupport(string $carrier, ?string $service): bool
    {
        if ($service === null) {
            return true;
        }

        $supportedCarriers = [
            Carrier::PPL,
            Carrier::DPD,
            Carrier::GLS,
            Carrier::ULOZENKA,
            Carrier::PBH,
            Carrier::SPS,
            Carrier::RABEN,
        ];

        return in_array($carrier, $supportedCarriers, true);
    }
}
