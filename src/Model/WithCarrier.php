<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model;

interface WithCarrier
{
    public function getCarrier(): string;
}
