<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Status;

use DateTimeInterface;
use Inspirum\Arrayable\Model;
use Inspirum\Balikobot\Model\WithCarrierId;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Status extends Model, WithCarrierId
{
    public function getId(): float;

    public function getName(): string;

    public function getDescription(): string;

    public function getType(): string;

    public function getDate(): ?DateTimeInterface;
}
