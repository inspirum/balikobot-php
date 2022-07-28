<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Provider;

interface CarrierProvider
{
    /**
     * @return array<string>
     */
    public function getCarriers(): array;
}
