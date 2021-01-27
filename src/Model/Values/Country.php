<?php

namespace Inspirum\Balikobot\Model\Values;

class Country
{
    /**
     * Names
     *
     * @var array<string,string>
     */
    private $names;

    /**
     * Alpha-2 country code
     *
     * @var string
     */
    private $code;

    /**
     * Continent name
     *
     * @var string
     */
    private $continent;

    /**
     * Phone prefixes
     *
     * @var array<string>
     */
    private $phonePrefixes;

    /**
     * Currency code
     *
     * @var string
     */
    private $currencyCode;

    /**
     * Country constructor
     *
     * @param array<string,string> $names
     * @param string               $code
     * @param string               $currencyCode
     * @param array<string>        $phonePrefixes
     * @param string               $continent
     */
    public function __construct(
        array $names,
        string $code,
        string $currencyCode,
        array $phonePrefixes,
        string $continent
    ) {
        $this->names         = $names;
        $this->code          = $code;
        $this->currencyCode  = $currencyCode;
        $this->phonePrefixes = $phonePrefixes;
        $this->continent     = $continent;
    }

    /**
     * @return array<string,string>
     */
    public function getNames(): array
    {
        return $this->names;
    }

    /**
     * @param string $locale
     *
     * @return string|null
     */
    public function getName(string $locale): ?string
    {
        return $this->names[$locale] ?? null;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getContinent(): string
    {
        return $this->continent;
    }

    /**
     * @return string
     */
    public function getPhonePrefix(): string
    {
        return $this->phonePrefixes[0];
    }

    /**
     * @return array<string>
     */
    public function getPhonePrefixes(): array
    {
        return $this->phonePrefixes;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Values\Country
     */
    public static function newInstanceFromData(array $data): self
    {
        return new self(
            [
                'cs' => $data['name_cz'],
                'en' => $data['name_en'],
            ],
            $data['iso_code'],
            $data['currency'],
            is_array($data['phone_prefix']) ? $data['phone_prefix'] : [$data['phone_prefix']],
            $data['continent']
        );
    }
}
