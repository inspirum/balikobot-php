<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Client\Request\Version;
use Inspirum\Balikobot\Model\Method\MethodCollection;
use function array_map;

/**
 * @extends \Inspirum\Arrayable\BaseModel<string,mixed>
 */
final class Carrier extends BaseModel implements CarrierType
{
    /**
     * @param array<string,\Inspirum\Balikobot\Model\Method\MethodCollection> $methods
     */
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly array $methods = [],
    ) {
    }

    public function getValue(): string
    {
        return $this->code;
    }

    public static function from(string $value): static
    {
        return new self($value, '');
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'code'    => $this->code,
            'name'    => $this->name,
            'methods' => array_map(static fn(MethodCollection $methods) => $methods->toArray(), $this->methods),
        ];
    }

    /**
     * @return array<array<string,string>>
     */
    public function getMethods(Version $version): array
    {
        return $this->methods[$version->getValue()]->toArray();
    }
}
