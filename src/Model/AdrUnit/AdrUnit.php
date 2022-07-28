<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Arrayable\Model;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface AdrUnit extends Model
{
    public function getCarrier(): string;

    public function getId(): string;

    public function getCode(): string;

    public function getName(): string;

    public function getClass(): string;

    public function getPackaging(): ?string;

    public function getTunnelCode(): ?string;

    public function getTransportCategory(): string;
}
