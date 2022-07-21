<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\Service;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class Service extends BaseModel implements Service
{
    /**
     * @param array<string>|null                                       $countries
     * @param array<\Inspirum\Balikobot\Model\Country\CodCountry>|null $codCountries
     */
    public function __construct(
        public readonly string $type,
        public readonly ?string $name,
        public readonly ?ServiceOptionCollection $options = null,
        public readonly ?array $countries = null,
        public readonly ?array $codCountries = null,
    ) {
    }

    public static function from(string $value): static
    {
        return new self($value, null);
    }

    public function getValue(): string
    {
        return $this->type;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'type'         => $this->type,
            'name'         => $this->name,
            'options'      => $this->options?->toArray(),
            'countries'    => $this->countries,
            'codCountries' => $this->codCountries,
        ];
    }
}
