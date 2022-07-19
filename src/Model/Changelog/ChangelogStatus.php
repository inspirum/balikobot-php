<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Changelog;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,string>
 */
final class ChangelogStatus extends BaseModel
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'name'        => $this->name,
            'description' => $this->description,
        ];
    }
}
