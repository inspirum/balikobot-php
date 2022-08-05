<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\AttributeType;

trait NotificationData
{
    public function setSmsNotification(bool $notification = true): void
    {
        $this->offsetSet(AttributeType::SMS_NOTIFICATION, (int) $notification);
    }

    public function setPhoneDeliveryNotification(bool $phoneDeliveryNotification = true): void
    {
        $this->offsetSet(AttributeType::PHONE_DELIVERY_NOTIFICATION, (int) $phoneDeliveryNotification);
    }

    public function setPhoneOrderNotification(bool $phoneOrderNotification = true): void
    {
        $this->offsetSet(AttributeType::PHONE_ORDER_NOTIFICATION, (int) $phoneOrderNotification);
    }

    public function setEmailNotification(bool $emailNotification = true): void
    {
        $this->offsetSet(AttributeType::EMAIL_NOTIFICATION, (int) $emailNotification);
    }

    public function setPhoneNotification(bool $phoneNotification = true): void
    {
        $this->offsetSet(AttributeType::PHONE_NOTIFICATION, (int) $phoneNotification);
    }

    public function setB2CNotification(bool $b2cNotification = true): void
    {
        $this->offsetSet(AttributeType::B2C_NOTIFICATION, (int) $b2cNotification);
    }

    public function setReference(string $reference): void
    {
        $this->offsetSet(AttributeType::REFERENCE, $reference);
    }

    public function setSM1Service(bool $service = true): void
    {
        $this->offsetSet(AttributeType::SM1_SERVICE, (int) $service);
    }

    public function setSM1Text(string $text): void
    {
        $this->offsetSet(AttributeType::SM1_TEXT, $text);
    }

    public function setSM2Service(bool $service = true): void
    {
        $this->offsetSet(AttributeType::SM2_SERVICE, (int) $service);
    }
}
