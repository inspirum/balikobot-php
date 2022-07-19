<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Account;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class Account extends BaseModel
{
    public function __construct(
        public readonly string $name,
        public readonly string $contactPerson,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $url,
        public readonly string $street,
        public readonly string $city,
        public readonly string $zip,
        public readonly string $country,
        public readonly bool $live,
        public readonly CarrierCollection $carriers,
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'name'          => $this->name,
            'contactPerson' => $this->contactPerson,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'url'           => $this->url,
            'street'        => $this->street,
            'city'          => $this->city,
            'zip'           => $this->zip,
            'country'       => $this->country,
            'live'          => $this->live,
            'carriers'      => $this->carriers->toArray(),

        ];
    }
}
