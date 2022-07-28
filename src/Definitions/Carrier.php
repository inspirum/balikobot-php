<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

final class Carrier
{
    /**
     * Česká pošta
     */
    public const CP = 'cp';

    /**
     * DPD
     */
    public const DPD = 'dpd';

    /**
     * DHL Express
     */
    public const DHL = 'dhl';

    /**
     * Geis Cargo - paletová přeprava
     */
    public const GEIS = 'geis';

    /**
     * GLS
     */
    public const GLS = 'gls';

    /**
     * WE DO
     */
    public const INTIME = 'intime';

    /**
     * Pošta bez hranic
     */
    public const PBH = 'pbh';

    /**
     * PPL + DHL Freight
     */
    public const PPL = 'ppl';

    /**
     * Slovenská pošta
     */
    public const SP = 'sp';

    /**
     * Slovak Parcel Service
     */
    public const SPS = 'sps';

    /**
     * Toptrans
     */
    public const TOPTRANS = 'toptrans';

    /**
     * WE DO - Uloženka
     */
    public const ULOZENKA = 'ulozenka';

    /**
     * UPS
     */
    public const UPS = 'ups';

    /**
     * Zásilkovna
     */
    public const ZASILKOVNA = 'zasilkovna';

    /**
     * TNT
     */
    public const TNT = 'tnt';

    /**
     * Gebrüder Weiss Slovensko
     */
    public const GW = 'gw';

    /**
     * Gebrüder Weiss Česká republika
     */
    public const GWCZ = 'gwcz';

    /**
     * Messenger
     */
    public const MESSENGER = 'messenger';

    /**
     * DHL DE
     */
    public const DHLDE = 'dhlde';

    /**
     * FedEx
     */
    public const FEDEX = 'fedex';

    /**
     * Fofr
     */
    public const FOFR = 'fofr';

    /**
     * Dachser
     */
    public const DACHSER = 'dachser';

    /**
     * DHL Parcel Europe - PPL Parcel Connect EU
     */
    public const DHLPARCEL = 'dhlparcel';

    /**
     * Raben
     */
    public const RABEN = 'raben';

    /**
     * Spring
     */
    public const SPRING = 'spring';

    /**
     * Spring
     */
    public const DSV = 'dsv';

    /**
     * DHL Freight Euroconnect
     */
    public const DHLFREIGHTEC = 'dhlfreightec';

    /**
     * 123kurier
     */
    public const KURIER = 'kurier';

    /**
     * DB Schenker
     */
    public const DBSCHENKER = 'dbschenker';

    /**
     * AIRWAY
     */
    public const AIRWAY = 'airway';

    /**
     * JAPO Transport
     */
    public const JAPO = 'japo';

    /**
     * Liftago
     */
    public const LIFTAGO = 'liftago';

    /**
     * Magyar posta
     */
    public const MAGYARPOSTA = 'magyarposta';

    /**
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
            self::MAGYARPOSTA,
        ];
    }
}
