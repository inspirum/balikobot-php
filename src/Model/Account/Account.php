<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Account;

use Inspirum\Arrayable\Model;
use Inspirum\Balikobot\Model\Carrier\CarrierCollection;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Account extends Model
{
    public function getName(): string;

    public function getContactPerson(): string;

    public function getEmail(): string;

    public function getPhone(): string;

    public function getUrl(): string;

    public function getStreet(): string;

    public function getCity(): string;

    public function getZipCode(): string;

    public function getCountry(): string;

    public function isLive(): bool;

    public function getCarriers(): CarrierCollection;
}
