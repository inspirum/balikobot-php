<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class Attribute extends BaseModel
{
    public function __construct(
        public readonly string $name,
        public readonly string $dataType,
        public readonly ?string $maxLength,
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'name' => $this->name,
            'dataType' => $this->dataType,
            'maxLength' => $this->maxLength,
        ];
    }
}
