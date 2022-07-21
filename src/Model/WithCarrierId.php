<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model;

use Inspirum\Balikobot\Client\Request\Carrier;

interface WithCarrierId
{
    public function getCarrier(): Carrier;

    public function getCarrierId(): string;
}
