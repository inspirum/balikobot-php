<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Provider;

interface CarrierProvider
{
    /**
     * @return list<string>
     */
    public function getCarriers(): array;
}
