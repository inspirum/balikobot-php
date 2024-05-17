<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Account;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultAccount extends BaseModel implements Account
{
    public function __construct(
        private readonly string $name,
        private readonly string $contactPerson,
        private readonly string $email,
        private readonly string $phone,
        private readonly string $url,
        private readonly string $street,
        private readonly string $city,
        private readonly string $zip,
        private readonly string $country,
        private readonly bool $live,
        private readonly CarrierCollection $carriers,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContactPerson(): string
    {
        return $this->contactPerson;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZipCode(): string
    {
        return $this->zip;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function isLive(): bool
    {
        return $this->live;
    }

    public function getCarriers(): CarrierCollection
    {
        return $this->carriers;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'name' => $this->name,
            'contactPerson' => $this->contactPerson,
            'email' => $this->email,
            'phone' => $this->phone,
            'url' => $this->url,
            'street' => $this->street,
            'city' => $this->city,
            'zip' => $this->zip,
            'country' => $this->country,
            'live' => $this->live,
            'carriers' => $this->carriers->__toArray(),

        ];
    }
}
