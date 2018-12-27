<?php

namespace Inspirum\Balikobot\Definitions;

use InvalidArgumentException;

class Shipper
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
     * TOPTRANS EU a.s.
     *
     * @var string
     */
    public const TOP_TRANS = 'toptrans';
    
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
     * All supported shipper services.
     *
     * @return array
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
            self::TOP_TRANS,
            self::ULOZENKA,
            self::UPS,
            self::ZASILKOVNA
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
}
