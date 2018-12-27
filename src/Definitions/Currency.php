<?php

namespace Inspirum\Balikobot\Definitions;

use InvalidArgumentException;

/**
 * Currencies in ISO 4217 format
 */
class Currency
{
    /**
     * Dolar
     *
     * @var string
     */
    public const AUD = 'AUD';
    
    /**
     * Real
     *
     * @var string
     */
    public const BRL = 'BRL';
    
    /**
     * Lev
     *
     * @var string
     */
    public const BGN = 'BGN';
    
    /**
     * Renminbi
     *
     * @var string
     */
    public const CNY = 'CNY';
    
    /**
     * Koruna
     *
     * @var string
     */
    public const DKK = 'DKK';
    
    /**
     * Euro
     *
     * @var string
     */
    public const EUR = 'EUR';
    
    /**
     * Koruna
     *
     * @var string
     */
    public const CZK = 'CZK';
    
    /**
     * Peso
     *
     * @var string
     */
    public const PHP = 'PHP';
    
    /**
     * Dolar
     *
     * @var string
     */
    public const HKD = 'HKD';
    
    /**
     * Kuna
     *
     * @var string
     */
    public const HRK = 'HRK';
    
    /**
     * Rupie
     *
     * @var string
     */
    public const INR = 'INR';
    
    /**
     * Rupie
     *
     * @var string
     */
    public const IDR = 'IDR';
    
    /**
     * Šekel
     *
     * @var string
     */
    public const ILS = 'ILS';
    
    /**
     * Jen
     *
     * @var string
     */
    public const JPY = 'JPY';
    
    /**
     * Rand
     *
     * @var string
     */
    public const ZAR = 'ZAR';
    
    /**
     * Won
     *
     * @var string
     */
    public const KRW = 'KRW';
    
    /**
     * Dolar
     *
     * @var string
     */
    public const CAD = 'CAD';
    
    /**
     * Forint
     *
     * @var string
     */
    public const HUF = 'HUF';
    
    /**
     * Ringgit
     *
     * @var string
     */
    public const MYR = 'MYR';
    
    /**
     * Peso
     *
     * @var string
     */
    public const MXN = 'MXN';
    
    /**
     * SDR
     *
     * @var string
     */
    public const XDR = 'XDR';
    
    /**
     * Koruna
     *
     * @var string
     */
    public const NOK = 'NOK';
    
    /**
     * Dolar
     *
     * @var string
     */
    public const NZD = 'NZD';
    
    /**
     * Zlotý
     *
     * @var string
     */
    public const PLN = 'PLN';
    
    /**
     * Nové leu
     *
     * @var string
     */
    public const RON = 'RON';
    
    /**
     * Rubl
     *
     * @var string
     */
    public const RUB = 'RUB';
    
    /**
     * Dolar
     *
     * @var string
     */
    public const SGD = 'SGD';
    
    /**
     * Koruna
     *
     * @var string
     */
    public const SEK = 'SEK';
    
    /**
     * Frank
     *
     * @var string
     */
    public const CHF = 'CHF';
    
    /**
     * Baht
     *
     * @var string
     */
    public const THB = 'THB';
    
    /**
     * Lira
     *
     * @var string
     */
    public const TRY = 'TRY';
    
    /**
     * Dolar
     *
     * @var string
     */
    public const USD = 'USD';
    
    /**
     * Libra
     *
     * @var string
     */
    public const GBP = 'GBP';
    
    /**
     * @return array
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
    
    /**
     * Validate currency code.
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
            throw new InvalidArgumentException('Invalid currency "' . $code . '" has been entered.');
        }
    }
}
