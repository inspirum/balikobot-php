<?php

namespace Inspirum\Balikobot\Definitions;

final class Request
{
    /**
     * Add a package
     *
     * @var string
     */
    public const ADD = 'add';

    /**
     * Drop a package
     *
     * @var string
     */
    public const DROP = 'drop';

    /**
     * Track a package
     *
     * @var string
     */
    public const TRACK = 'track';

    /**
     * Track a package; get the last brief info
     *
     * @var string
     */
    public const TRACK_STATUS = 'trackstatus';

    /**
     * List of packages
     *
     * @var string
     */
    public const OVERVIEW = 'overview';

    /**
     * Get labels
     *
     * @var string
     */
    public const LABELS = 'labels';

    /**
     * Get the package info
     *
     * @var string
     */
    public const PACKAGE = 'package';

    /**
     * Order shipment
     *
     * @var string
     */
    public const ORDER = 'order';

    /**
     * Get the shipment details
     *
     * @var string
     */
    public const ORDER_VIEW = 'orderview';

    /**
     * Get the shipment pickup details
     *
     * @var string
     */
    public const ORDER_PICKUP = 'orderpickup';

    /**
     * List of offered services
     *
     * @var string
     */
    public const SERVICES = 'services';

    /**
     * List of units for palette shipping
     *
     * @var string
     */
    public const MANIPULATION_UNITS = 'manipulationunits';

    /**
     * List of activated units for palette shipping
     *
     * @var string
     */
    public const ACTIVATED_MANIPULATION_UNITS = 'activatedmanipulationunits';

    /**
     * List of available branches
     *
     * @var string
     */
    public const BRANCHES = 'branches';

    /**
     * List of available branches with details
     *
     * @var string
     */
    public const FULL_BRANCHES = 'fullbranches';

    /**
     * List of available branches with details for given location
     *
     * @var string
     */
    public const BRANCH_LOCATOR = 'branchlocator';

    /**
     * List of services with countries which support cash-on-delivery payment type
     *
     * @var string
     */
    public const CASH_ON_DELIVERY_COUNTRIES = 'cod4services';

    /**
     * List of available countries
     *
     * @var string
     */
    public const COUNTRIES = 'countries4service';

    /**
     * List of available zip codes
     *
     * @var string
     */
    public const ZIP_CODES = 'zipcodes';

    /**
     * Check add-package data
     *
     * @var string
     */
    public const CHECK = 'check';

    /**
     * List of ADR units
     *
     * @var string
     */
    public const ADR_UNITS = 'adrunits';

    /**
     * List of activated services for production API keys
     *
     * @var string
     */
    public const ACTIVATEDSERVICES = 'activatedservices';

    /**
     * Order shipments from place B (typically supplier / previous consignee) to place A (shipping point)
     *
     * @var string
     */
    public const B2A = 'b2a';

    /**
     * Get PDF with signed consignment delivery document by the recipient
     *
     * @var string
     */
    public const PROOF_OF_DELIVERY = 'pod';
}
