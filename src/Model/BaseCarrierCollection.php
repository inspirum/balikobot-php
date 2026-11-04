<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model;

use Inspirum\Arrayable\BaseListCollection;
use InvalidArgumentException;
use RuntimeException;
use function sprintf;

/**
 * @template TItemKey of array-key
 * @template TItemValue
 * @template TValue of \Inspirum\Arrayable\Arrayable<TItemKey,TItemValue>&\Inspirum\Balikobot\Model\WithCarrier
 * @extends \Inspirum\Arrayable\BaseListCollection<TItemKey,TItemValue,TValue>
 */
abstract class BaseCarrierCollection extends BaseListCollection
{
    /**
     * @param list<TValue> $items
     */
    public function __construct(
        private ?string $carrier = null,
        array $items = [],
    ) {
        parent::__construct();

        foreach ($items as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * @throws \RuntimeException
     */
    public function getCarrier(): string
    {
        return $this->carrier ?? throw new RuntimeException('Collection is empty');
    }

    /**
     * @param non-negative-int $key
     * @param TValue $value
     */
    public function offsetSet(mixed $key, mixed $value): void
    {
        $this->validateCarrier($value);

        parent::offsetSet($key, $value);
    }

    /**
     * @param TValue $value
     */
    public function offsetAdd(mixed $value): void
    {
        $this->validateCarrier($value);

        parent::offsetAdd($value);
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function validateCarrier(WithCarrier $item): void
    {
        if ($this->carrier === null) {
            $this->carrier = $item->getCarrier();

            return;
        }

        if ($this->carrier !== $item->getCarrier()) {
            throw new InvalidArgumentException(
                sprintf(
                    'Item carrier mismatch ("%s" instead "%s")',
                    $item->getCarrier(),
                    $this->carrier,
                ),
            );
        }
    }
}
