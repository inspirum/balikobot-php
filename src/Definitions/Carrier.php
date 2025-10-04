<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

use function array_filter;
use function array_values;
use function in_array;

final class Carrier extends BaseEnum
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
     *
     * @deprecated Replaced by One by Allegro
     *
     * @see self::ONEBYALLEGRO
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
     *
     * @deprecated Terminated
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
     * Sameday
     */
    public const SAMEDAY = 'sameday';

    /**
     * Sameday
     */
    public const SDS = 'sds';

    /**
     * Quality Delivery Logistics
     *
     * @deprecated Terminated
     */
    public const QDL = 'qdl';

    /**
     * Inpost
     */
    public const INPOST = 'inpost';

    /**
     * One by Allegro
     */
    public const ONEBYALLEGRO = 'onebyallegro';

    /**
     * @return list<string>
     */
    public static function getAll(): array
    {
        return array_values(array_filter(parent::getAll(), static fn (string $value): bool => !in_array($value, [self::ULOZENKA])));
    }
}
