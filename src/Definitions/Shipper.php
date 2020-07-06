<?php

namespace Inspirum\Balikobot\Definitions;

use InvalidArgumentException;

final class Shipper
{
    /**
     * Česká pošta s.p.
     *
     * @var string
     */
    public const CP = 'cp';

    /**
     * Direct Parcel Distribution CZ s.r.o.
     *
     * @var string
     */
    public const DPD = 'dpd';

    /**
     * DHL Express
     *
     * @var string
     */
    public const DHL = 'dhl';

    /**
     * Geis CZ s.r.o.
     *
     * @var string
     */
    public const GEIS = 'geis';

    /**
     * General Logistics Systems Czech Republic s.r.o.
     *
     * @var string
     */
    public const GLS = 'gls';

    /**
     * IN TIME SPEDICE s.r.o.
     *
     * @var string
     */
    public const INTIME = 'intime';

    /**
     * Pošta bez hranic (Frogman s.r.o.)
     *
     * @var string
     */
    public const PBH = 'pbh';

    /**
     * PPL CZ s.r.o.
     *
     * @var string
     */
    public const PPL = 'ppl';

    /**
     * Slovenská pošta a.s.,
     *
     * @var string
     */
    public const SP = 'sp';

    /**
     * Slovak Parcel Service s.r.o.
     *
     * @var string
     */
    public const SPS = 'sps';

    /**
     * TOPTRANS EU a.s.
     *
     * @var string
     */
    public const TOPTRANS = 'toptrans';

    /**
     * Uloženka s.r.o.
     *
     * @var string
     */
    public const ULOZENKA = 'ulozenka';

    /**
     * UPS SCS Czech Republic s.r.o.
     *
     * @var string
     */
    public const UPS = 'ups';

    /**
     * Zásilkovna s.r.o.
     *
     * @var string
     */
    public const ZASILKOVNA = 'zasilkovna';

    /**
     * TNT
     *
     * @var string
     */
    public const TNT = 'tnt';

    /**
     * Gebrüder Weiss
     *
     * @var string
     */
    public const GW = 'gw';

    /**
     * Gebrüder Weiss Česká republika
     *
     * @var string
     */
    public const GWCZ = 'gwcz';

    /**
     * Messenger
     *
     * @var string
     */
    public const MESSENGER = 'messenger';

    /**
     * All supported shipper services.
     *
     * @return array<string>
     */
    public static function all(): array
    {
        return [
            self::CP,
            self::DHL,
            self::DPD,
            self::GEIS,
            self::GLS,
            self::INTIME,
            self::PBH,
            self::PPL,
            self::SP,
            self::SPS,
            self::TOPTRANS,
            self::ULOZENKA,
            self::UPS,
            self::ZASILKOVNA,
            self::TNT,
            self::GW,
            self::GWCZ,
            self::MESSENGER,
        ];
    }

    /**
     * Validate shipper code.
     *
     * @param string $code
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public static function validateCode(string $code): void
    {
        if (in_array($code, self::all()) === false) {
            throw new InvalidArgumentException('Unknown shipper "' . $code . '".');
        }
    }

    /**
     * Determine if shipper service support full branch API
     *
     * @param string      $shipperCode
     * @param string|null $serviceCode
     *
     * @return bool
     */
    public static function hasFullBranchesSupport(string $shipperCode, ?string $serviceCode): bool
    {
        if ($shipperCode == Shipper::ZASILKOVNA) {
            return true;
        }

        if ($shipperCode == Shipper::CP && $serviceCode === ServiceType::CP_NP) {
            return true;
        }

        $services = [ServiceType::PBH_MP, ServiceType::PBH_FAN_KURIER];
        if ($shipperCode == Shipper::PBH && in_array($serviceCode, $services)) {
            return true;
        }

        return false;
    }

    /**
     * Resolve ADD request version
     *
     * @param string                     $shipperCode
     * @param array<array<string,mixed>> $packagesData
     *
     * @return string
     */
    public static function resolveAddRequestVersion(string $shipperCode, array $packagesData): string
    {
        $supportedShippers = [Shipper::ZASILKOVNA];
        if (in_array($shipperCode, $supportedShippers) && isset($packagesData[0][Option::SERVICE_TYPE])) {
            return API::V2;
        }

        $supportedShippers = [Shipper::UPS, Shipper::DHL, Shipper::TNT, Shipper::TOPTRANS];
        if (in_array($shipperCode, $supportedShippers) && isset($packagesData[0][Option::ORDER_NUMBER])) {
            return API::V2;
        }

        return API::V1;
    }

    /**
     * Resolve SERVICES request version
     *
     * @param string $shipperCode
     *
     * @return string
     */
    public static function resolveServicesRequestVersion(string $shipperCode): string
    {
        $supportedShippers = [Shipper::ZASILKOVNA];

        if (in_array($shipperCode, $supportedShippers)) {
            return API::V2;
        }

        return API::V1;
    }

    /**
     * Resolve BRANCHES request version
     *
     * @param string      $shipperCode
     * @param string|null $serviceCode
     *
     * @return string
     */
    public static function resolveBranchesRequestVersion(string $shipperCode, ?string $serviceCode): string
    {
        $supportedShippers = [Shipper::ZASILKOVNA];

        if (in_array($shipperCode, $supportedShippers) && $serviceCode !== null) {
            return API::V2;
        }

        return API::V1;
    }

    /**
     * Determine if shipper has support to filter branches by country code.
     *
     * @param string $shipperCode
     *
     * @return bool
     */
    public static function hasBranchCountryFilterSupport(string $shipperCode): bool
    {
        $supportedShippers = [
            Shipper::DPD,
            Shipper::GLS,
            Shipper::PPL,
        ];

        return in_array($shipperCode, $supportedShippers);
    }
}
