<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\AdrUnit;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\Carrier;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
class AdrUnit extends BaseModel
{
    public function __construct(
        public readonly Carrier $carrier,
        public readonly string $id,
        public readonly string $code,
        public readonly string $name,
        public readonly string $class,
        public readonly ?string $packaging,
        public readonly ?string $tunnelCode,
        public readonly string $transportCategory
    ) {
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'class' => $this->class,
            'packaging' => $this->packaging,
            'tunnelCode' => $this->tunnelCode,
            'transportCategory' => $this->transportCategory,
        ];
    }
}
