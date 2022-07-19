<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client\Request;

interface CarrierType
{
    public function getValue(): string;
}
