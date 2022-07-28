<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultCodCountry extends BaseModel implements CodCountry
{
    public function __construct(
        private string $code,
        private string $currencyCode,
        private float $maxPrice,
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    public function getMaxPrice(): float
    {
        return $this->maxPrice;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'code'         => $this->code,
            'currencyCode' => $this->currencyCode,
            'maxPrice'     => $this->maxPrice,
        ];
    }
}
