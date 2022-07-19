<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client\Request;

interface Version
{
    public function getValue(): string;
}
