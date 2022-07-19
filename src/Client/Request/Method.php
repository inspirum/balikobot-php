<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client\Request;

interface Method
{
    public function getValue(): string;
}
