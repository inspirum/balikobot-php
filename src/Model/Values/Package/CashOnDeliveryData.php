<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values\Package;

use Inspirum\Balikobot\Definitions\Option;

trait CashOnDeliveryData
{
    /**
     * Set the item at a given offset
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    abstract public function offsetSet($key, $value): void;

    /**
     * @param float $codPrice
     *
     * @return void
     */
    public function setCodPrice(float $codPrice): void
    {
        $this->offsetSet(Option::COD_PRICE, $codPrice);
    }

    /**
     * @param string $codCurrency
     *
     * @return void
     */
    public function setCodCurrency(string $codCurrency): void
    {
        $this->offsetSet(Option::COD_CURRENCY, $codCurrency);
    }

    /**
     * @param string $vs
     *
     * @return void
     */
    public function setVS(string $vs): void
    {
        $this->offsetSet(Option::VS, $vs);
    }

    /**
     * @param bool $creditCard
     *
     * @return void
     */
    public function setCreditCard(bool $creditCard = true): void
    {
        $this->offsetSet(Option::CREDIT_CARD, (int) $creditCard);
    }
}
