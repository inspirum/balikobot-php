<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ZipCode;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultZipCode extends BaseModel implements ZipCode
{
    public function __construct(
        private readonly string $carrier,
        private readonly ?string $service,
        private readonly ?string $zipCode,
        private readonly ?string $zipCodeEnd,
        private readonly ?string $city,
        private readonly ?string $region,
        private readonly ?string $country,
        private readonly bool $morningDelivery,
    ) {
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function getZipCodeEnd(): ?string
    {
        return $this->zipCodeEnd;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function isMorningDelivery(): bool
    {
        return $this->morningDelivery;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'carrier' => $this->carrier,
            'service' => $this->service,
            'zipCode' => $this->zipCode,
            'zipCodeEnt' => $this->zipCodeEnd,
            'city' => $this->city,
            'region' => $this->region,
            'country' => $this->country,
            'morningDelivery' => $this->morningDelivery,
        ];
    }
}
