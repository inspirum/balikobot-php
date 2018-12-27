<?php

namespace Inspirum\Balikobot\Model\Values;

class PostCode
{
    /**
     * @var string
     */
    private $shipper;
    
    /**
     * @var string|null
     */
    private $service;
    
    /**
     * @var string
     */
    private $postcode;
    
    /**
     * @var string|null
     */
    private $postcodeEnd;
    
    /**
     * @var string|null
     */
    private $city;
    
    /**
     * @var string|null
     */
    private $country;
    
    /**
     * @var bool
     */
    private $morningDelivery;
    
    /**
     * Postcode constructor.
     *
     * @param string      $shipper
     * @param string|null $service
     * @param string      $postcode
     * @param string|null $postcodeEnd
     * @param string|null $city
     * @param string|null $country
     * @param bool        $morningDelivery
     */
    public function __construct(
        string $shipper,
        ?string $service,
        string $postcode,
        ?string $postcodeEnd,
        ?string $city,
        ?string $country,
        bool $morningDelivery
    ) {
        $this->shipper         = $shipper;
        $this->service         = $service;
        $this->postcode        = $postcode;
        $this->postcodeEnd     = $postcodeEnd;
        $this->city            = $city;
        $this->country         = $country;
        $this->morningDelivery = $morningDelivery;
    }
    
    /**
     * @return string
     */
    public function getShipper(): string
    {
        return $this->shipper;
    }
    
    /**
     * @return string|null
     */
    public function getService(): ?string
    {
        return $this->service;
    }
    
    /**
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }
    
    /**
     * @return string|null
     */
    public function getPostcodeEnd(): ?string
    {
        return $this->postcodeEnd;
    }
    
    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }
    
    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }
    
    /**
     * @return bool
     */
    public function isMorningDelivery(): bool
    {
        return $this->morningDelivery;
    }
    
    /**
     * New instance from data
     *
     * @param string      $shipper
     * @param string|null $service
     * @param array       $data
     *
     * @return \Inspirum\Balikobot\Model\Values\PostCode
     */
    public static function newInstanceFromData(string $shipper, ?string $service, array $data): self
    {
        return new self(
            $shipper,
            $service,
            $data['postcode'],
            $data['postcode_end'] ?? null,
            $data['city'] ?? null,
            $data['country'] ?? null,
            $data['1B'] ?? false
        );
    }
}
