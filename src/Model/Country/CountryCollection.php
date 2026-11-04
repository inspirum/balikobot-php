<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\Country\Country>
 */
interface CountryCollection extends ListCollection
{
    /**
     * @return list<\Inspirum\Balikobot\Model\Country\Country>
     */
    public function getCountries(): array;
}
