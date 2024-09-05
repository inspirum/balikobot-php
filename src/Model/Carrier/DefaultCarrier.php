<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Model\Method\MethodCollection;
use function array_map;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class DefaultCarrier extends BaseModel implements Carrier
{
    /**
     * @param array<string,\Inspirum\Balikobot\Model\Method\MethodCollection> $methods
     */
    public function __construct(
        private readonly string $code,
        private readonly string $name,
        private readonly array $methods = [],
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /** @inheritDoc */
    public function getMethods(): array
    {
        return $this->methods;
    }

    public function getMethodsForVersion(string $version): MethodCollection
    {
        return $this->methods[$version];
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'methods' => array_map(static fn (MethodCollection $methods) => $methods->__toArray(), $this->methods),
        ];
    }
}
