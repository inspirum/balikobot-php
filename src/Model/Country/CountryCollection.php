<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\Country\Country>
 */
interface CountryCollection extends Collection
{
    /**
     * @return array<int,\Inspirum\Balikobot\Model\Country\Country>
     */
    public function getCountries(): array;
}
