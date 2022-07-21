<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

use Inspirum\Balikobot\Client\Request\Method;

enum Request: string implements Method
{
    case  TRACK                        = 'track';
    case  TRACK_STATUS                 = 'trackstatus';
    case  BRANCHES                     = 'branches';
    case  FULL_BRANCHES                = 'fullbranches';
    case  BRANCH_LOCATOR               = 'branchlocator';
    case  ADD                          = 'add';
    case  DROP                         = 'drop';
    case  OVERVIEW                     = 'overview';
    case  LABELS                       = 'labels';
    case  PACKAGE                      = 'package';
    case  ORDER                        = 'order';
    case  ORDER_VIEW                   = 'orderview';
    case  ORDER_PICKUP                 = 'orderpickup';
    case  CHECK                        = 'check';
    case  PROOF_OF_DELIVERY            = 'pod';
    case  TRANSPORT_COSTS              = 'transportcosts';
    case  ADD_SERVICE_OPTIONS          = 'addserviceoptions';
    case  ADD_ATTRIBUTES               = 'addattributes';
    case  B2A                          = 'b2a';
    case  B2A_SERVICES                 = 'b2a/services';
    case  INFO_WHO_AM_I                = 'info/whoami';
    case  INFO_CARRIERS                = 'info/carriers';
    case  CHANGELOG                    = 'changelog';
    case  SERVICES                     = 'services';
    case  ACTIVATED_SERVICES           = 'activatedservices';
    case  GET_COUNTRIES_DATA           = 'getCountriesData';
    case  MANIPULATION_UNITS           = 'manipulationunits';
    case  ACTIVATED_MANIPULATION_UNITS = 'activatedmanipulationunits';
    case  CASH_ON_DELIVERY_COUNTRIES   = 'cod4services';
    case  COUNTRIES                    = 'countries4service';
    case  ZIP_CODES                    = 'zipcodes';
    case  ADR_UNITS                    = 'adrunits';
    case  FULL_ADR_UNITS               = 'fulladrunits';

    public function getValue(): string
    {
        return $this->value;
    }
}
