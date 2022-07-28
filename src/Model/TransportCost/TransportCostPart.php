<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\TransportCost;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface TransportCostPart extends Model
{
    public function getName(): string;

    public function getCost(): float;

    public function getCurrencyCode(): string;
}
