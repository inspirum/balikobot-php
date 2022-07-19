<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use Inspirum\Arrayable\BaseCollection;
use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Model\WithCarrierId;
use InvalidArgumentException;
use function sprintf;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<int,\Inspirum\Balikobot\Model\Status\Status>
 */
final class Statuses extends BaseCollection implements WithCarrierId
{
    /**
     * @param array<\Inspirum\Balikobot\Model\Status\Status> $states
     */
    public function __construct(
        private CarrierType $carrier,
        private string $carrierId,
        array $states,
    ) {
        parent::__construct([]);

        foreach ($states as $key => $value) {
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

    public function getCarrier(): CarrierType
    {
        return $this->carrier;
    }

    public function getCarrierId(): string
    {
        return $this->carrierId;
    }

    /**
     * @return array<\Inspirum\Balikobot\Model\Status\Status>
     */
    public function getStates(): array
    {
        return $this->items;
    }

    /**
     * @return array<string,string|array<string, mixed>>
     */
    public function __toArray(): array
    {
        return [
            'carrier'   => $this->carrier->getValue(),
            'carrierId' => $this->carrierId,
            'states'    => parent::__toArray(),
        ];
    }
}
