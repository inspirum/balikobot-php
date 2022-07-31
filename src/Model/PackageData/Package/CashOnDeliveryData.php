<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Option;

trait CashOnDeliveryData
{
    public function setCodPrice(float $codPrice): void
    {
        $this->offsetSet(Option::COD_PRICE, $codPrice);
    }

    public function setCodCurrency(string $codCurrency): void
    {
        $this->offsetSet(Option::COD_CURRENCY, $codCurrency);
    }

    public function setVS(string $vs): void
    {
        $this->offsetSet(Option::VS, $vs);
    }

    public function setCreditCard(bool $creditCard = true): void
    {
        $this->offsetSet(Option::CREDIT_CARD, (int) $creditCard);
    }
}
