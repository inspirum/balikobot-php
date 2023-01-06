<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Attribute;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultAttribute extends BaseModel implements Attribute
{
    public function __construct(
        private readonly string $name,
        private readonly string $dataType,
        private readonly ?string $maxLength,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDataType(): string
    {
        return $this->dataType;
    }

    public function getMaxLength(): ?string
    {
        return $this->maxLength;
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
