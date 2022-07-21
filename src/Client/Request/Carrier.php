<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client\Request;

interface Carrier
{
    public function getValue(): string;
}
