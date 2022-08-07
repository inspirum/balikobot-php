<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Attribute;

trait NotificationData
{
    public function setSmsNotification(bool $notification = true): void
    {
        $this->offsetSet(Attribute::SMS_NOTIFICATION, (int) $notification);
    }

    public function setPhoneDeliveryNotification(bool $phoneDeliveryNotification = true): void
    {
        $this->offsetSet(Attribute::PHONE_DELIVERY_NOTIFICATION, (int) $phoneDeliveryNotification);
    }

    public function setPhoneOrderNotification(bool $phoneOrderNotification = true): void
    {
        $this->offsetSet(Attribute::PHONE_ORDER_NOTIFICATION, (int) $phoneOrderNotification);
    }

    public function setEmailNotification(bool $emailNotification = true): void
    {
        $this->offsetSet(Attribute::EMAIL_NOTIFICATION, (int) $emailNotification);
    }

    public function setPhoneNotification(bool $phoneNotification = true): void
    {
        $this->offsetSet(Attribute::PHONE_NOTIFICATION, (int) $phoneNotification);
    }

    public function setB2CNotification(bool $b2cNotification = true): void
    {
        $this->offsetSet(Attribute::B2C_NOTIFICATION, (int) $b2cNotification);
    }

    public function setReference(string $reference): void
    {
        $this->offsetSet(Attribute::REFERENCE, $reference);
    }

    public function setSM1Service(bool $service = true): void
    {
        $this->offsetSet(Attribute::SM1_SERVICE, (int) $service);
    }

    public function setSM1Text(string $text): void
    {
        $this->offsetSet(Attribute::SM1_TEXT, $text);
    }

    public function setSM2Service(bool $service = true): void
    {
        $this->offsetSet(Attribute::SM2_SERVICE, (int) $service);
    }
}
