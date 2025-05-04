<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

use function in_array;

final class Status
{
    /**
     * Ordered
     */
    public const ORDERED = -1.0;

    /**
     * Picked up at the sender
     */
    public const PICKED_UP_FROM_SENDER = 2.1;

    /**
     * Transit
     */
    public const TRANSIT = 2.2;

    /**
     * Ready to pick up
     */
    public const READY_TO_PICK_UP = 2.3;

    /**
     * Back on the way to the sender
     */
    public const SEND_BACK_TO_SENDER = 2.4;

    /**
     * Handed over to the final carrier
     */
    public const HANDED_TO_FINAL_CARRIER = 2.5;

    /**
     * Cancellation by the carrier
     */
    public const CANCELLATION_BY_CARRIER = 3.1;

    /**
     * Cancellation by the recipient
     */
    public const CANCELLATION_BY_RECIPIENT = 3.2;

    /**
     * Cancellation by the sender
     */
    public const CANCELLATION_BY_SENDER = 3.3;

    /**
     * Delivered back to sender
     */
    public const DELIVERED_BACK_TO_SENDER = 4.0;

    /**
     * Cash on delivery has been credited to the sender's account
     */
    public const COD_PAID = 5.0;

    /**
     * Carrier error
     */
    public const ERROR_CARRIER = 0.1;

    /**
     * Error on the part of the recipient
     */
    public const ERROR_RECIPIENT = 0.2;

    /**
     * Error on the part of the sender
     */
    public const ERROR_SENDER = 0.3;

    /**
     * Collection of the consignment at the delivery point
     */
    public const PICKUP_ON_DELIVERY_POINT = 1.1;

    /**
     * Delivered to address
     */
    public const DELIVERED_TO_ADDRESS = 1.2;

    /**
     * Is package delivered to customer
     */
    public static function isDelivered(float $status): bool
    {
        return self::isStatus($status, [
            self::PICKUP_ON_DELIVERY_POINT,
            self::DELIVERED_TO_ADDRESS,
        ]);
    }

    /**
     * Package delivery failed
     */
    public static function isError(float $status): bool
    {
        return self::isStatus($status, [
            self::ERROR_CARRIER,
            self::ERROR_RECIPIENT,
            self::ERROR_SENDER,
        ]);
    }

    /**
     * Package is being delivered to customer
     */
    public static function isBeingDelivered(float $status): bool
    {
        return self::isStatus($status, [
            self::ORDERED,
            self::PICKED_UP_FROM_SENDER,
            self::TRANSIT,
            self::READY_TO_PICK_UP,
            self::HANDED_TO_FINAL_CARRIER,
        ]);
    }

    /**
     * Package delivery processed ended
     */
    public static function isClosed(float $status): bool
    {
        return self::isStatus($status, [
            self::DELIVERED_BACK_TO_SENDER,
            self::COD_PAID,
            self::PICKUP_ON_DELIVERY_POINT,
            self::DELIVERED_TO_ADDRESS,
        ]);
    }

    /**
     * Check if given ID is in any of given statuses
     *
     * @param array<float> $statuses
     */
    private static function isStatus(float $status, array $statuses): bool
    {
        return in_array($status, $statuses, true);
    }
}
