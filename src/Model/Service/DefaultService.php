<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Service;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Model\Country\CodCountry;
use function array_map;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultService extends BaseModel implements Service
{
    /**
     * @param list<string>|null $countries
     * @param array<\Inspirum\Balikobot\Model\Country\CodCountry>|null $codCountries
     */
    public function __construct(
        private readonly string $type,
        private readonly ?string $name,
        private readonly ?ServiceOptionCollection $options = null,
        private readonly ?array $countries = null,
        private readonly ?array $codCountries = null,
    ) {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOptions(): ?ServiceOptionCollection
    {
        return $this->options;
    }

    /** @inheritDoc */
    public function getCountries(): ?array
    {
        return $this->countries;
    }

    /** @inheritDoc */
    public function getCodCountries(): ?array
    {
        return $this->codCountries;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'type' => $this->type,
            'name' => $this->name,
            'options' => $this->options?->__toArray(),
            'countries' => $this->countries,
            'codCountries' => $this->codCountries !== null ? array_map(static fn (CodCountry $country): array => $country->__toArray(), $this->codCountries)
                : null,
        ];
    }
}
