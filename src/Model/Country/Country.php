<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class Country extends BaseModel
{
    /**
     * @param array<string,string> $names
     * @param array<string>        $phonePrefixes
     */
    public function __construct(
        public readonly array $names,
        public readonly string $code,
        public readonly string $currencyCode,
        public readonly array $phonePrefixes,
        public readonly string $continent
    ) {
    }

    public function getName(string $locale): ?string
    {
        return $this->names[$locale] ?? null;
    }

    public function getPhonePrefix(): string
    {
        return $this->phonePrefixes[0];
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'names'         => $this->names,
            'code'          => $this->code,
            'currencyCode'  => $this->currencyCode,
            'phonePrefixes' => $this->phonePrefixes,
            'continent'     => $this->continent,
        ];
    }
}
