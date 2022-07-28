<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Arrayable\BaseCollection;
use InvalidArgumentException;
use function sprintf;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<int,\Inspirum\Balikobot\Model\Status\Status>
 */
final class DefaultStatuses extends BaseCollection implements Statuses
{
    /**
     * @param array<\Inspirum\Balikobot\Model\Status\Status> $items
     */
    public function __construct(
        private string $carrier,
        private string $carrierId,
        array $items = [],
    ) {
        parent::__construct([]);

        foreach ($items as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    public function offsetSet(mixed $key, mixed $value): void
    {
        $this->validateCarrierId($value);

        parent::offsetSet($key, $value);
    }

    public function offsetAdd(mixed $value): void
    {
        $this->validateCarrierId($value);

        parent::offsetAdd($value);
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function validateCarrierId(Status $item): void
    {
        if ($this->carrier !== $item->getCarrier()) {
            throw new InvalidArgumentException(
                sprintf(
                    'Item carrier mismatch ("%s" instead "%s")',
                    $item->getCarrier(),
                    $this->carrier,
                )
            );
        }

        if ($this->carrierId !== $item->getCarrierId()) {
            throw new InvalidArgumentException(
                sprintf(
                    'Item carrier ID mismatch ("%s" instead "%s")',
                    $item->getCarrierId(),
                    $this->carrierId,
                )
            );
        }
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getCarrierId(): string
    {
        return $this->carrierId;
    }

    /** @inheritDoc */
    public function getStates(): array
    {
        return $this->items;
    }

    /**
     * @return array<string,string|array<string,mixed>>
     */
    public function __toArray(): array
    {
        return [
            'carrier'   => $this->carrier,
            'carrierId' => $this->carrierId,
            'states'    => parent::__toArray(),
        ];
    }
}
