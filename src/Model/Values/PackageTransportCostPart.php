<?php

namespace Inspirum\Balikobot\Model\Values;

class PackageTransportCostPart
{
    /**
     * Part name
     *
     * @var string
     */
    private $name;

    /**
     * Part cost
     *
     * @var float
     */
    private $cost;

    /**
     * Currency code
     *
     * @var string
     */
    private $currencyCode;

    /**
     * PackageTransportCost constructor.
     *
     * @param string $name
     * @param float  $cost
     * @param string $currencyCode
     */
    public function __construct(string $name, float $cost, string $currencyCode)
    {
        $this->name         = $name;
        $this->cost         = $cost;
        $this->currencyCode = $currencyCode;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }
}
