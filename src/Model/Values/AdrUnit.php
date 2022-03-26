<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Values;

class AdrUnit
{
    /**
     * @var string
     */
    private string $shipper;

    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $code;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $class;

    /**
     * @var string|null
     */
    private ?string $packaging;

    /**
     * @var string|null
     */
    private ?string $tunnelCode;

    /**
     * @var string
     */
    private string $transportCategory;

    /**
     * @param string      $shipper
     * @param string      $id
     * @param string      $code
     * @param string      $name
     * @param string      $class
     * @param string|null $packaging
     * @param string|null $tunnelCode
     * @param string      $transportCategory
     */
    public function __construct(
        string $shipper,
        string $id,
        string $code,
        string $name,
        string $class,
        ?string $packaging,
        ?string $tunnelCode,
        string $transportCategory
    ) {
        $this->shipper           = $shipper;
        $this->id                = $id;
        $this->code              = $code;
        $this->name              = $name;
        $this->class             = $class;
        $this->packaging         = $packaging;
        $this->tunnelCode        = $tunnelCode;
        $this->transportCategory = $transportCategory;
    }

    /**
     * @return string
     */
    public function getShipper(): string
    {
        return $this->shipper;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return string|null
     */
    public function getPackaging(): ?string
    {
        return $this->packaging;
    }

    /**
     * @return string|null
     */
    public function getTunnelCode(): ?string
    {
        return $this->tunnelCode;
    }

    /**
     * @return string
     */
    public function getTransportCategory(): string
    {
        return $this->transportCategory;
    }

    /**
     * New instance from data
     *
     * @param string              $shipper
     * @param array<string,mixed> $data
     *
     * @return \Inspirum\Balikobot\Model\Values\AdrUnit
     */
    public static function newInstanceFromData(string $shipper, array $data): self
    {
        return new self(
            $shipper,
            $data['id'],
            $data['code'],
            $data['name'],
            $data['class'],
            $data['packaging'],
            $data['tunnel_code'],
            $data['transport_category'],
        );
    }
}
