<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PostCode;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Client\Request\ServiceType;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class PostCode extends BaseModel
{
    public function __construct(
        public readonly CarrierType $carrier,
        public readonly ?ServiceType $service,
        public readonly string $postcode,
        public readonly ?string $postcodeEnd,
        public readonly ?string $city,
        public readonly ?string $country,
        public readonly bool $morningDelivery
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'carrier'         => $this->carrier->getValue(),
            'service'         => $this->service,
            'postcode'        => $this->postcode,
            'postcodeEnd'     => $this->postcodeEnd,
            'city'            => $this->city,
            'country'         => $this->country,
            'morningDelivery' => $this->morningDelivery,
        ];
    }
}
