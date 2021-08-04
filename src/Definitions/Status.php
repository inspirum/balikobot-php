<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

final class Status
{
    /**
     * Ordered (v1, v2)
     *
     * @var float
     */
    public const ORDERED = -1.0;

    /**
     * Transit (v1)
     *
     * @deprecated
     *
     * @var float
     */
    public const TRANSIT_V1 = 2.0;

    /**
     * Picked up at the sender (v2)
     *
     * @var float
     */
    public const PICKED_UP_FROM_SENDER = 2.1;

    /**
     * Transit (v2)
     *
     * @var float
     */
    public const TRANSIT = 2.2;

    /**
     * Ready to pick up (v2)
     *
     * @var float
     */
    public const READY_TO_PICK_UP = 2.3;

    /**
     * Back on the way to the sender (v2)
     *
     * @var float
     */
    public const SEND_BACK_TO_SENDER = 2.4;

    /**
     * Handed over to the final carrier (v2)
     *
     * @var float
     */
    public const HANDED_TO_FINAL_SHIPPER = 2.5;

    /**
     * Cancellation (v1)
     *
     * @deprecated
     *
     * @var float
     */
    public const CANCELLATION = 3.0;

    /**
     * Cancellation by the carrier (v2)
     *
     * @var float
     */
    public const CANCELLATION_BY_SHIPPER = 3.1;

    /**
     * Cancellation by the recipient (v2)
     *
     * @var float
     */
    public const CANCELLATION_BY_RECIPIENT = 3.2;

    /**
     * Cancellation by the sender (v2)
     *
     * @var float
     */
    public const CANCELLATION_BY_SENDER = 3.3;

    /**
     * Delivered back to sender (v1, v2)
     *
     * @var float
     */
    public const DELIVERED_BACK_TO_SENDER = 4.0;

    /**
     * Cash on delivery has been credited to the sender's account (v1)
     *
     * @deprecated
     *
     * @var float
     */
    public const COD_PAID = 5.0;

    /**
     * Error (v1)
     *
     * @deprecated
     *
     * @var float
     */
    public const ERROR = 2.0;

    /**
     * Carrier error (v2)
     *
     * @var float
     */
    public const ERROR_SHIPPER = 0.1;

    /**
     * Error on the part of the recipient (v2)
     *
     * @var float
     */
    public const ERROR_RECIPIENT = 0.2;

    /**
     * Error on the part of the sender (v2)
     *
     * @var float
     */
    public const ERROR_SENDER = 0.3;

    /**
     * Delivered (v1)
     *
     * @deprecated
     *
     * @var float
     */
    public const DELIVERED = 1.0;

    /**
     * Collection of the consignment at the delivery point (v2)
     *
     * @var float
     */
    public const PICKUP_ON_DELIVERY_POINT = 1.1;

    /**
     * Delivered to address (v2)
     *
     * @var float
     */
    public const DELIVERED_TO_ADDRESS = 1.2;
}
