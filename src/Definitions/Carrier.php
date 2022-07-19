<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Client\Request\ServiceType;

enum Carrier: string implements CarrierType
{
    case CP           = 'cp';
    case DPD          = 'dpd';
    case DHL          = 'dhl';
    case GEIS         = 'geis';
    case GLS          = 'gls';
    case INTIME       = 'intime';
    case PBH          = 'pbh';
    case PPL          = 'ppl';
    case SP           = 'sp';
    case SPS          = 'sps';
    case TOPTRANS     = 'toptrans';
    case ULOZENKA     = 'ulozenka';
    case UPS          = 'ups';
    case ZASILKOVNA   = 'zasilkovna';
    case TNT          = 'tnt';
    case GW           = 'gw';
    case GWCZ         = 'gwcz';
    case MESSENGER    = 'messenger';
    case DHLDE        = 'dhlde';
    case FEDEX        = 'fedex';
    case FOFR         = 'fofr';
    case DACHSER      = 'dachser';
    case DHLPARCEL    = 'dhlparcel';
    case RABEN        = 'raben';
    case SPRING       = 'spring';
    case DSV          = 'dsv';
    case DHLFREIGHTEC = 'dhlfreightec';
    case KURIER       = 'kurier';
    case DBSCHENKER   = 'dbschenker';
    case AIRWAY       = 'airway';
    case JAPO         = 'japo';
    case LIFTAGO      = 'liftago';
    case MAGYARPOSTA  = 'magyarposta';

    public function getValue(): string
    {
        return $this->value;
    }

    public static function hasBranchCountryFilterSupport(CarrierType $carrier, ?ServiceType $service): bool
    {
        // TODO:
        return false;
    }

    public static function hasFullBranchesSupport(CarrierType $carrier, ?ServiceType $service): bool
    {
        // TODO:
        return false;
    }
}
