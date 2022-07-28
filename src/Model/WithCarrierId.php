<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model;

interface WithCarrierId
{
    public function getCarrier(): string;

    public function getCarrierId(): string;
}
