<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultAdrUnit extends BaseModel implements AdrUnit
{
    public function __construct(
        private readonly string $carrier,
        private readonly string $id,
        private readonly string $code,
        private readonly string $name,
        private readonly string $class,
        private readonly ?string $packaging,
        private readonly ?string $tunnelCode,
        private readonly string $transportCategory,
    ) {
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getPackaging(): ?string
    {
        return $this->packaging;
    }

    public function getTunnelCode(): ?string
    {
        return $this->tunnelCode;
    }

    public function getTransportCategory(): string
    {
        return $this->transportCategory;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'class' => $this->class,
            'packaging' => $this->packaging,
            'tunnelCode' => $this->tunnelCode,
            'transportCategory' => $this->transportCategory,
        ];
    }
}
