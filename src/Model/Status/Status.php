<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use DateTimeInterface;
use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\Carrier;
use Inspirum\Balikobot\Model\WithCarrierId;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class Status extends BaseModel implements WithCarrierId
{
    public function __construct(
        public readonly Carrier $carrier,
        public readonly string $carrierId,
        public readonly float $id,
        public readonly string $name,
        public readonly string $description,
        public readonly string $type,
        public readonly ?DateTimeInterface $date,
    ) {
    }

    public function getCarrier(): Carrier
    {
        return $this->carrier;
    }

    public function getCarrierId(): string
    {
        return $this->carrierId;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'carrier'     => $this->carrier->getValue(),
            'carrierId'   => $this->carrierId,
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'type'        => $this->type,
            'date'        => $this->date?->format(DateTimeInterface::ATOM),
        ];
    }
}
