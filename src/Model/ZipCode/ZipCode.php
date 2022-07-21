<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ZipCode;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Client\Request\Service;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class ZipCode extends BaseModel
{
    public function __construct(
        public readonly Carrier $carrier,
        public readonly ?Service $service,
        public readonly ?string $zipCode,
        public readonly ?string $zipCodeEnd,
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
            'service'         => $this->service?->getValue(),
            'zipCode'         => $this->zipCode,
            'zipCodeEnt'      => $this->zipCodeEnd,
            'city'            => $this->city,
            'country'         => $this->country,
            'morningDelivery' => $this->morningDelivery,
        ];
    }
}
