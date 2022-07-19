<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

use Inspirum\Arrayable\BaseModel;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class Method extends BaseModel implements \Inspirum\Balikobot\Client\Request\Method
{
    public function __construct(
        public readonly string $code,
    ) {
    }

    public function getValue(): string
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
