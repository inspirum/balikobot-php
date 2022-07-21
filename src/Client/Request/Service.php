<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client\Request;

use Stringable;

interface Service extends Stringable
{
    public function getValue(): string;
}
