<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Branch;

use IteratorIterator;
use Traversable;

/**
 * @extends \IteratorIterator<int,\Inspirum\Balikobot\Model\Branch\Branch,\Traversable<int,\Inspirum\Balikobot\Model\Branch\Branch>>
 */
final class DefaultBranchIterator extends IteratorIterator implements BranchIterator
{
    /**
     * @param array<string> $countries
     * @param \Traversable<int,\Inspirum\Balikobot\Model\Branch\Branch> $iterator
     */
    public function __construct(
        private readonly ?string $carrier,
        private readonly ?string $service,
        private readonly ?array $countries,
        Traversable $iterator,
    ) {
        parent::__construct($iterator);
    }

    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    /** @inheritDoc */
    public function getCountries(): ?array
    {
        return $this->countries;
    }
}
