<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Service;
use function in_array;

final class DefaultBranchResolver implements BranchResolver
{
    public function hasFullBranchesSupport(string $carrier, ?string $service): bool
    {
        $supported = [
            Carrier::ZASILKOVNA => null,
            Carrier::CP => [
                Service::CP_NP,
                Service::CP_NB,
            ],
            Carrier::PBH => [
                Service::PBH_DHL,
                Service::PBH_SPS,
                Service::PBH_SP,
                Service::PBH_MP,
                Service::PBH_RP,
                Service::PBH_CP_NP,
                Service::PBH_INPOST_KURIER,
                Service::PBH_FAN_KURIER,
                Service::PBH_SPEEDY,
                Service::PBH_ECONT,
                Service::PBH_HR_POST,
                Service::PBH_BOX_NOW,
                Service::PBH_SI,
                Service::PBH_ITELLA,
            ],
            Carrier::DPD => [
                Service::DPD_PICKUP,
            ],
            Carrier::GLS => [
                Service::GLS_SHOP,
                Service::GLS_GUARANTEED24_SHOP,
            ],
            Carrier::INTIME => [
                Service::INTIME_POSTOMAT_CZ,
                Service::INTIME_BOX_CZ,
                Service::INTIME_BOX_SK,
            ],
            Carrier::SPS => [
                Service::SPS_EXPRESS,
                Service::SPS_INTERNATIONAL,
            ],
            Carrier::SP => [
                Service::SP_BZP,
                Service::SP_BZB,
                Service::SP_EXP,
                Service::SP_EXB,
                Service::SP_BNP,
                Service::SP_BNB,
            ],
            Carrier::ULOZENKA => [
                Service::ULOZENKA_ULOZENKA,
                Service::ULOZENKA_DPD_PARCEL,
                Service::ULOZENKA_CP_NP,
                Service::ULOZENKA_PARTNER,
                Service::ULOZENKA_EXPRESS_SK,
                Service::ULOZENKA_BALIKOBOX_SK,
                Service::ULOZENKA_DEPO_SK,
            ],
            Carrier::PPL => [
                Service::PPL_CONNECT,
                Service::PPL_PRIVATE,
                Service::PPL_PRIVATE_SMART_CZ,
                Service::PPL_PRIVATE_SMART_EU,
            ],
            Carrier::SAMEDAY => [
                Service::SAMEDAY_LOCKER_NEXT_DAY,
                Service::SAMEDAY_LOCKER_RETURN,
                Service::SAMEDAY_CROSSBORDER_LOCKER_HD,
            ],
            Carrier::MAGYARPOSTA => null,
            Carrier::RABEN => [
                Service::RABEN_CLASSIC_TIME,
                Service::RABEN_PREMIUM_TIME,
            ],
            Carrier::DHLFREIGHTEC => [
                Service::DHLFREIGHTEC_ECD_B2B,
                Service::DHLFREIGHTEC_ECD_B2C,
            ],
            Carrier::KURIER => [
                Service::KURIER_GARANTED,
                Service::KURIER_GARANTED_BRANCH,
                Service::KURIER_STANDARD,
                Service::KURIER_STANDARD_BRANCH,
            ],
        ];

        return $this->hasSupport($supported, $carrier, $service);
    }

    public function hasBranchCountryFilterSupport(string $carrier, ?string $service): bool
    {
        if ($service === null) {
            return true;
        }

        $supported = [
            Carrier::PPL => null,
            Carrier::DPD => null,
            Carrier::GLS => null,
            Carrier::ULOZENKA => null,
            Carrier::PBH => [
                Service::PBH_DHL,
                Service::PBH_CP_NP,
                Service::PBH_SPS,
                Service::PBH_SP,
                Service::PBH_MP,
                Service::PBH_RP,
                Service::PBH_INPOST_KURIER,
                Service::PBH_FAN_KURIER,
                Service::PBH_SPEEDY,
                Service::PBH_ECONT,
                Service::PBH_HR_POST,
                Service::PBH_BOX_NOW,
                Service::PBH_SI,
                Service::PBH_ITELLA,
            ],
            Carrier::SPS => null,
            Carrier::RABEN => null,
            Carrier::SAMEDAY => null,
            Carrier::ZASILKOVNA => null,
            Carrier::KURIER => null,
            Carrier::MAGYARPOSTA => null,
        ];

        return $this->hasSupport($supported, $carrier, $service);
    }

    /**
     * @param array<string,list<string>|null> $supported
     */
    private function hasSupport(array $supported, string $carrier, ?string $service): bool
    {
        foreach ($supported as $supportedCarrier => $supportedServices) {
            if ($carrier === $supportedCarrier && ($supportedServices === null || in_array($service, $supportedServices, true))) {
                return true;
            }
        }

        return false;
    }
}
