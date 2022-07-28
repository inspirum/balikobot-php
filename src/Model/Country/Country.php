<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Country extends Model
{
    /**
     * @return array<string>
     */
    public function getNames(): array;

    public function getName(string $locale): ?string;

    public function getCode(): string;

    public function getCurrencyCode(): string;

    /**
     * @return array<string>
     */
    public function getPhonePrefixes(): array;

    public function getPhonePrefix(): string;

    public function getContinent(): string;
}
