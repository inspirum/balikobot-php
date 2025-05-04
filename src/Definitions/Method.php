<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

final class Method extends BaseEnum
{
    /**
     * Add a package
     */
    public const ADD = 'add';

    /**
     * Drop a package
     */
    public const DROP = 'drop';

    /**
     * Track a package
     */
    public const TRACK = 'track';

    /**
     * Track a package; get the last brief info
     */
    public const TRACK_STATUS = 'trackstatus';

    /**
     * List of packages
     */
    public const OVERVIEW = 'overview';

    /**
     * Get labels
     */
    public const LABELS = 'labels';

    /**
     * Get the package info
     */
    public const PACKAGE = 'package';

    /**
     * Order shipment
     */
    public const ORDER = 'order';

    /**
     * Get the shipment details
     */
    public const ORDER_VIEW = 'orderview';

    /**
     * Get the shipment pickup details
     */
    public const ORDER_PICKUP = 'orderpickup';

    /**
     * List of offered services
     */
    public const SERVICES = 'services';

    /**
     * List of units for palette shipping
     */
    public const MANIPULATION_UNITS = 'manipulationunits';

    /**
     * List of activated units for palette shipping
     */
    public const ACTIVATED_MANIPULATION_UNITS = 'activatedmanipulationunits';

    /**
     * List of available branches
     */
    public const BRANCHES = 'branches';

    /**
     * List of available branches with details
     */
    public const FULL_BRANCHES = 'fullbranches';

    /**
     * List of available branches with details for given location
     */
    public const BRANCH_LOCATOR = 'branchlocator';

    /**
     * List of services with countries which support cash-on-delivery payment type
     */
    public const CASH_ON_DELIVERY_COUNTRIES = 'cod4services';

    /**
     * List of available countries
     */
    public const COUNTRIES = 'countries4service';

    /**
     * List of available zip codes
     */
    public const ZIP_CODES = 'zipcodes';

    /**
     * Check add-package data
     */
    public const CHECK = 'check';

    /**
     * List of ADR units
     */
    public const ADR_UNITS = 'adrunits';

    /**
     * Detailed list of ADR units
     */
    public const FULL_ADR_UNITS = 'fulladrunits';

    /**
     * List of activated services for production API keys
     */
    public const ACTIVATED_SERVICES = 'activatedservices';

    /**
     * Order shipments from place B (typically supplier / previous consignee) to place A (shipping point)
     */
    public const B2A = 'b2a';

    /**
     * Get PDF with signed consignment delivery document by the recipient
     */
    public const PROOF_OF_DELIVERY = 'pod';

    /**
     * Method for obtaining the price of carriage at consignment level
     */
    public const TRANSPORT_COSTS = 'transportcosts';

    /**
     * Method for obtaining information on individual countries of the world
     */
    public const GET_COUNTRIES_DATA = 'getCountriesData';

    /**
     * Method for obtaining news in the Balikobot API
     */
    public const CHANGELOG = 'changelog';

    /**
     * Method for obtaining a list of additional services by individual transport services
     */
    public const ADD_SERVICE_OPTIONS = 'addserviceoptions';

    /**
     * Experimental method for easier carrier integration
     * List of available input attributes for the ADD method of the selected carrier
     */
    public const ADD_ATTRIBUTES = 'addattributes';

    /**
     * Method for obtaining info about used API keys
     */
    public const INFO_WHO_AM_I = 'info/whoami';

    /**
     * Method for obtaining a list of active carriers.
     */
    public const INFO_CARRIERS = 'info/carriers';

    /**
     * List of offered B2A services
     */
    public const B2A_SERVICES = 'b2a/services';

    /**
     * Order shipments from place B (typically supplier / previous consignee) to place C (different address of the client than the place of dispatch)
     */
    public const B2C = 'b2c';

    /**
     * Check add-package data for B2A
     */
    public const B2A_CHECK = 'checkb2a';

    /**
     * Check add-package data for B2c
     */
    public const B2C_CHECK = 'checkb2c';

    /**
     * @deprecated
     */
    public const ADR = 'adr';
}
