<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

use InvalidArgumentException;
use function in_array;

final class Shipper
{
    /**
     * Česká pošta
     *
     * @var string
     */
    public const CP = 'cp';

    /**
     * DPD
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
     * Geis Cargo - paletová přeprava
     *
     * @var string
     */
    public const GEIS = 'geis';

    /**
     * GLS
     *
     * @var string
     */
    public const GLS = 'gls';

    /**
     * WE DO
     *
     * @var string
     */
    public const INTIME = 'intime';

    /**
     * Pošta bez hranic
     *
     * @var string
     */
    public const PBH = 'pbh';

    /**
     * PPL + DHL Freight
     *
     * @var string
     */
    public const PPL = 'ppl';

    /**
     * Slovenská pošta
     *
     * @var string
     */
    public const SP = 'sp';

    /**
     * Slovak Parcel Service
     *
     * @var string
     */
    public const SPS = 'sps';

    /**
     * Toptrans
     *
     * @var string
     */
    public const TOPTRANS = 'toptrans';

    /**
     * WE DO - Uloženka
     *
     * @var string
     */
    public const ULOZENKA = 'ulozenka';

    /**
     * UPS
     *
     * @var string
     */
    public const UPS = 'ups';

    /**
     * Zásilkovna
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
     * Gebrüder Weiss Slovensko
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
     * DHL DE
     *
     * @var string
     */
    public const DHLDE = 'dhlde';

    /**
     * FedEx
     *
     * @var string
     */
    public const FEDEX = 'fedex';

    /**
     * Fofr
     *
     * @var string
     */
    public const FOFR = 'fofr';

    /**
     * Dachser
     *
     * @var string
     */
    public const DACHSER = 'dachser';

    /**
     * DHL Parcel Europe - PPL Parcel Connect EU
     *
     * @var string
     */
    public const DHLPARCEL = 'dhlparcel';

    /**
     * Raben
     *
     * @var string
     */
    public const RABEN = 'raben';

    /**
     * Spring
     *
     * @var string
     */
    public const SPRING = 'spring';

    /**
     * Spring
     *
     * @var string
     */
    public const DSV = 'dsv';

    /**
     * DHL Freight Euroconnect
     *
     * @var string
     */
    public const DHLFREIGHTEC = 'dhlfreightec';

    /**
     * 123kurier
     *
     * @var string
     */
    public const KURIER = 'kurier';

    /**
     * DB Schenker
     *
     * @var string
     */
    public const DBSCHENKER = 'dbschenker';

    /**
     * AIRWAY
     *
     * @var string
     */
    public const AIRWAY = 'airway';

    /**
     * JAPO Transport
     *
     * @var string
     */
    public const JAPO = 'japo';

    /**
     * Liftago
     *
     * @var string
     */
    public const LIFTAGO = 'liftago';

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
            self::DHLDE,
            self::FEDEX,
            self::FOFR,
            self::DACHSER,
            self::DHLPARCEL,
            self::RABEN,
            self::SPRING,
            self::DSV,
            self::DHLFREIGHTEC,
            self::KURIER,
            self::DBSCHENKER,
            self::AIRWAY,
            self::JAPO,
            self::LIFTAGO,
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
        if ($shipperCode === self::ZASILKOVNA) {
            return true;
        }

        if ($shipperCode === self::CP && $serviceCode === ServiceType::CP_NP) {
            return true;
        }

        $services = [ServiceType::PBH_MP, ServiceType::PBH_FAN_KURIER];

        return $shipperCode === self::PBH && in_array($serviceCode, $services);
    }

    /**
     * Determine if shipper has support to filter branches by country code.
     *
     * @param string      $shipperCode
     * @param string|null $serviceCode
     *
     * @return bool
     */
    public static function hasBranchCountryFilterSupport(string $shipperCode, ?string $serviceCode): bool
    {
        if ($serviceCode === null) {
            return true;
        }

        $supportedShippers = [
            self::PPL,
            self::DPD,
            self::GEIS,
            self::GLS,
        ];

        return in_array($shipperCode, $supportedShippers);
    }
}
