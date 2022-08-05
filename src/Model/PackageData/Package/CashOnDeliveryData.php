<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData\Package;

use Inspirum\Balikobot\Definitions\AttributeType;

trait CashOnDeliveryData
{
    public function setCodPrice(float $codPrice): void
    {
        $this->offsetSet(AttributeType::COD_PRICE, $codPrice);
    }

    public function setCodCurrency(string $codCurrency): void
    {
        $this->offsetSet(AttributeType::COD_CURRENCY, $codCurrency);
    }

    public function setVS(string $vs): void
    {
        $this->offsetSet(AttributeType::VS, $vs);
    }

    public function setCreditCard(bool $creditCard = true): void
    {
        $this->offsetSet(AttributeType::CREDIT_CARD, (int) $creditCard);
    }
}
