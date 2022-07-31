<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Option;

trait NotificationData
{
    public function setSmsNotification(bool $notification = true): void
    {
        $this->offsetSet(Option::SMS_NOTIFICATION, (int) $notification);
    }

    public function setPhoneDeliveryNotification(bool $phoneDeliveryNotification = true): void
    {
        $this->offsetSet(Option::PHONE_DELIVERY_NOTIFICATION, (int) $phoneDeliveryNotification);
    }

    public function setPhoneOrderNotification(bool $phoneOrderNotification = true): void
    {
        $this->offsetSet(Option::PHONE_ORDER_NOTIFICATION, (int) $phoneOrderNotification);
    }

    public function setEmailNotification(bool $emailNotification = true): void
    {
        $this->offsetSet(Option::EMAIL_NOTIFICATION, (int) $emailNotification);
    }

    public function setPhoneNotification(bool $phoneNotification = true): void
    {
        $this->offsetSet(Option::PHONE_NOTIFICATION, (int) $phoneNotification);
    }

    public function setB2CNotification(bool $b2cNotification = true): void
    {
        $this->offsetSet(Option::B2C_NOTIFICATION, (int) $b2cNotification);
    }

    public function setReference(string $reference): void
    {
        $this->offsetSet(Option::REFERENCE, $reference);
    }

    public function setSM1Service(bool $service = true): void
    {
        $this->offsetSet(Option::SM1_SERVICE, (int) $service);
    }

    public function setSM1Text(string $text): void
    {
        $this->offsetSet(Option::SM1_TEXT, $text);
    }

    public function setSM2Service(bool $service = true): void
    {
        $this->offsetSet(Option::SM2_SERVICE, (int) $service);
    }
}
