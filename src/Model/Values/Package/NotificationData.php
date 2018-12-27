<?php

namespace Inspirum\Balikobot\Model\Values\Package;

use Inspirum\Balikobot\Definitions\Option;

trait NotificationData
{
    /**
     * Set the item at a given offset.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    abstract public function offsetSet($key, $value);
    
    /**
     * @param bool $notification
     *
     * @return void
     */
    public function setSmsNotification(bool $notification = true): void
    {
        $this->offsetSet(Option::SMS_NOTIFICATION, (int) $notification);
    }
    
    /**
     * @param bool $phoneDeliveryNotification
     *
     * @return void
     */
    public function setPhoneDeliveryNotification(bool $phoneDeliveryNotification = true): void
    {
        $this->offsetSet(Option::PHONE_DELIVERY_NOTIFICATION, (int) $phoneDeliveryNotification);
    }
    
    /**
     * @param bool $phoneOrderNotification
     *
     * @return void
     */
    public function setPhoneOrderNotification(bool $phoneOrderNotification = true): void
    {
        $this->offsetSet(Option::PHONE_ORDER_NOTIFICATION, (int) $phoneOrderNotification);
    }
    
    /**
     * @param bool $emailNotification
     *
     * @return void
     */
    public function setEmailNotification(bool $emailNotification = true): void
    {
        $this->offsetSet(Option::EMAIL_NOTIFICATION, (int) $emailNotification);
    }
    
    /**
     * @param bool $phoneNotification
     *
     * @return void
     */
    public function setPhoneNotification(bool $phoneNotification = true): void
    {
        $this->offsetSet(Option::PHONE_NOTIFICATION, (int) $phoneNotification);
    }
    
    /**
     * @param bool $b2cNotification
     *
     * @return void
     */
    public function setB2CNotification(bool $b2cNotification = true): void
    {
        $this->offsetSet(Option::B2C_NOTIFICATION, (int) $b2cNotification);
    }
}
