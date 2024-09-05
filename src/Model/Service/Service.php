<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Service extends Model
{
    public function getType(): string;

    public function getName(): ?string;

    public function getOptions(): ?ServiceOptionCollection;

    /**
     * @return list<string>|null
     */
    public function getCountries(): ?array;

    /**
     * @return array<\Inspirum\Balikobot\Model\Country\CodCountry>|null
     */
    public function getCodCountries(): ?array;
}
