<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\ManipulationUnit;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class ManipulationUnit extends BaseModel
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
        ];
    }
}
