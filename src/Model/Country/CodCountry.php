<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class CodCountry extends BaseModel
{
    public function __construct(
        public readonly string $code,
        public readonly string $currencyCode,
        public readonly float $maxPrice,
    ) {
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
