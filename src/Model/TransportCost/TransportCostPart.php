<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class TransportCostPart extends BaseModel
{
    public function __construct(
        private string $name,
        private float $cost,
        private string $currencyCode,
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'name'         => $this->name,
            'cost'         => $this->cost,
            'currencyCode' => $this->currencyCode,
        ];
    }
}
