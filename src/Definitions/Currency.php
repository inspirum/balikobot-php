<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

final class Currency
{
    /**
     * Dolar
     */
    public const AUD = 'AUD';

    /**
     * Real
     */
    public const BRL = 'BRL';

    /**
     * Lev
     */
    public const BGN = 'BGN';

    /**
     * Renminbi
     */
    public const CNY = 'CNY';

    /**
     * Koruna
     */
    public const DKK = 'DKK';

    /**
     * Euro
     */
    public const EUR = 'EUR';

    /**
     * Koruna
     */
    public const CZK = 'CZK';

    /**
     * Peso
     */
    public const PHP = 'PHP';

    /**
     * Dolar
     */
    public const HKD = 'HKD';

    /**
     * Kuna
     */
    public const HRK = 'HRK';

    /**
     * Rupie
     */
    public const INR = 'INR';

    /**
     * Rupie
     */
    public const IDR = 'IDR';

    /**
     * Šekel
     */
    public const ILS = 'ILS';

    /**
     * Jen
     */
    public const JPY = 'JPY';

    /**
     * Rand
     */
    public const ZAR = 'ZAR';

    /**
     * Won
     */
    public const KRW = 'KRW';

    /**
     * Dolar
     */
    public const CAD = 'CAD';

    /**
     * Forint
     */
    public const HUF = 'HUF';

    /**
     * Ringgit
     */
    public const MYR = 'MYR';

    /**
     * Peso
     */
    public const MXN = 'MXN';

    /**
     * SDR
     */
    public const XDR = 'XDR';

    /**
     * Koruna
     */
    public const NOK = 'NOK';

    /**
     * Dolar
     */
    public const NZD = 'NZD';

    /**
     * Zlotý
     */
    public const PLN = 'PLN';

    /**
     * Nové leu
     */
    public const RON = 'RON';

    /**
     * Rubl
     */
    public const RUB = 'RUB';

    /**
     * Dolar
     */
    public const SGD = 'SGD';

    /**
     * Koruna
     */
    public const SEK = 'SEK';

    /**
     * Frank
     */
    public const CHF = 'CHF';

    /**
     * Baht
     */
    public const THB = 'THB';

    /**
     * Lira
     */
    public const TRY = 'TRY';

    /**
     * Dolar
     */
    public const USD = 'USD';

    /**
     * Libra
     */
    public const GBP = 'GBP';

    /**
     * @return array<string>
     */
    public static function all(): array
    {
        return [
            self::AUD,
            self::BRL,
            self::BGN,
            self::CNY,
            self::DKK,
            self::EUR,
            self::CZK,
            self::PHP,
            self::HKD,
            self::HRK,
            self::INR,
            self::IDR,
            self::ILS,
            self::JPY,
            self::ZAR,
            self::KRW,
            self::CAD,
            self::HUF,
            self::MYR,
            self::MXN,
            self::XDR,
            self::NOK,
            self::NZD,
            self::PLN,
            self::RON,
            self::RUB,
            self::SGD,
            self::SEK,
            self::CHF,
            self::THB,
            self::TRY,
            self::USD,
            self::GBP,
        ];
    }
}
