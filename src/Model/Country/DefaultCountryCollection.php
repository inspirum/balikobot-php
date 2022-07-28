<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use Inspirum\Arrayable\BaseCollection;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\Country\Country>
 */
final class DefaultCountryCollection extends BaseCollection implements CountryCollection
{
    /** @inheritDoc */
    public function getCountries(): array
    {
        return $this->getItems();
    }
}
