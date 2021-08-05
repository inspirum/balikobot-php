<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

use function in_array;

final class Status
{
    /**
     * Ordered
     *
     * @var float
     */
    public const ORDERED = -1.0;

    /**
     * Picked up at the sender
     *
     * @var float
     */
    public const PICKED_UP_FROM_SENDER = 2.1;

    /**
     * Transit
     *
     * @var float
     */
    public const TRANSIT = 2.2;

    /**
     * Ready to pick up
     *
     * @var float
     */
    public const READY_TO_PICK_UP = 2.3;

    /**
     * Back on the way to the sender
     *
     * @var float
     */
    public const SEND_BACK_TO_SENDER = 2.4;

    /**
     * Handed over to the final carrier
     *
     * @var float
     */
    public const HANDED_TO_FINAL_SHIPPER = 2.5;

    /**
     * Cancellation by the carrier
     *
     * @var float
     */
    public const CANCELLATION_BY_SHIPPER = 3.1;

    /**
     * Cancellation by the recipient
     *
     * @var float
     */
    public const CANCELLATION_BY_RECIPIENT = 3.2;

    /**
     * Cancellation by the sender
     *
     * @var float
     */
    public const CANCELLATION_BY_SENDER = 3.3;

    /**
     * Delivered back to sender
     *
     * @var float
     */
    public const DELIVERED_BACK_TO_SENDER = 4.0;

    /**
     * Cash on delivery has been credited to the sender's account
     *
     * @var float
     */
    public const COD_PAID = 5.0;

    /**
     * Carrier error
     *
     * @var float
     */
    public const ERROR_SHIPPER = 0.1;

    /**
     * Error on the part of the recipient
     *
     * @var float
     */
    public const ERROR_RECIPIENT = 0.2;

    /**
     * Error on the part of the sender
     *
     * @var float
     */
    public const ERROR_SENDER = 0.3;

    /**
     * Collection of the consignment at the delivery point
     *
     * @var float
     */
    public const PICKUP_ON_DELIVERY_POINT = 1.1;

    /**
     * Delivered to address
     *
     * @var float
     */
    public const DELIVERED_TO_ADDRESS = 1.2;

    /**
     * Is package delivered to customer
     *
     * @param float $status
     *
     * @return bool
     */
    public static function isDelivered(float $status): bool
    {
        return self::inStatuses($status, [
            self::PICKUP_ON_DELIVERY_POINT,
            self::DELIVERED_TO_ADDRESS,
        ]);
    }

    /**
     * Package delivery failed
     *
     * @param float $status
     *
     * @return bool
     */
    public static function isError(float $status): bool
    {
        return self::inStatuses($status, [
            self::ERROR_SHIPPER,
            self::ERROR_RECIPIENT,
            self::ERROR_SENDER,
        ]);
    }

    /**
     * Package is being delivered to customer
     *
     * @param float $status
     *
     * @return bool
     */
    public static function isBeingDelivered(float $status): bool
    {
        return self::inStatuses($status, [
            self::ORDERED,
            self::PICKED_UP_FROM_SENDER,
            self::TRANSIT,
            self::READY_TO_PICK_UP,
            self::HANDED_TO_FINAL_SHIPPER,
        ]);
    }

    /**
     * Package delivery processed ended
     *
     * @param float $status
     *
     * @return bool
     */
    public static function isClosed(float $status): bool
    {
        return self::inStatuses($status, [
            self::DELIVERED_BACK_TO_SENDER,
            self::COD_PAID,
            self::PICKUP_ON_DELIVERY_POINT,
            self::DELIVERED_TO_ADDRESS,
        ]);
    }

    /**
     * Check if given ID is in any of given statuses
     *
     * @param float        $status
     * @param array<float> $statuses
     *
     * @return bool
     */
    private static function inStatuses(float $status, array $statuses): bool
    {
        return in_array($status, $statuses, true);
    }
}
