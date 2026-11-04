<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model;

interface WithCarrierId extends WithCarrier
{
    public function getCarrierId(): string;
}
