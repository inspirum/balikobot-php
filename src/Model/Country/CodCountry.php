<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface CodCountry extends Model
{
    public function getCode(): string;

    public function getCurrencyCode(): string;

    public function getMaxPrice(): float;
}
