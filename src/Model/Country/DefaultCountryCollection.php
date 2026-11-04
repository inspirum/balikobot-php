<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Country;

use Inspirum\Arrayable\BaseListCollection;

/**
 * @extends \Inspirum\Arrayable\BaseListCollection<string,mixed,\Inspirum\Balikobot\Model\Country\Country>
 */
final class DefaultCountryCollection extends BaseListCollection implements CountryCollection
{
    /** @inheritDoc */
    public function getCountries(): array
    {
        return $this->getItems();
    }
}
