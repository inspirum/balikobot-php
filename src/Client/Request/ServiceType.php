<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client\Request;

use Stringable;

interface ServiceType extends Stringable
{
    public function getValue(): string;
}
