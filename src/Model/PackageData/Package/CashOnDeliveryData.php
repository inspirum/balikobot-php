<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\Attribute;

trait CashOnDeliveryData
{
    public function setCodPrice(float $codPrice): void
    {
        $this->offsetSet(Attribute::COD_PRICE, $codPrice);
    }

    public function setCodCurrency(string $codCurrency): void
    {
        $this->offsetSet(Attribute::COD_CURRENCY, $codCurrency);
    }

    public function setVS(string $vs): void
    {
        $this->offsetSet(Attribute::VS, $vs);
    }

    public function setCreditCard(bool $creditCard = true): void
    {
        $this->offsetSet(Attribute::CREDIT_CARD, (int) $creditCard);
    }
}
