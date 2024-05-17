<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use DateTimeInterface;
use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultStatus extends BaseModel implements Status
{
    public function __construct(
        private readonly string $carrier,
        private readonly string $carrierId,
        private readonly float $id,
        private readonly string $name,
        private readonly string $description,
        private readonly string $type,
        private readonly ?DateTimeInterface $date,
    ) {
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getCarrierId(): string
    {
        return $this->carrierId;
    }

    public function getId(): float
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'carrier' => $this->carrier,
            'carrierId' => $this->carrierId,
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'date' => $this->date?->format(DateTimeInterface::ATOM),
        ];
    }
}
