<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use DateTimeInterface;
use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class Changelog extends BaseModel
{
    public function __construct(
        public readonly string $version,
        public readonly DateTimeInterface $date,
        public readonly ChangelogStatusCollection $changes,
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'code'    => $this->version,
            'date'    => $this->date->format('Y-m-d'),
            'changes' => $this->changes->toArray(),
        ];
    }
}
