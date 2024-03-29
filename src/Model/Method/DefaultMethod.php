<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultMethod extends BaseModel implements Method
{
    public function __construct(
        private readonly string $code,
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'code' => $this->code,
        ];
    }
}
