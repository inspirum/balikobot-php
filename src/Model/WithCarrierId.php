<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model;

use Inspirum\Balikobot\Client\Request\CarrierType;

interface WithCarrierId
{
    public function getCarrier(): CarrierType;

    public function getCarrierId(): string;
}
