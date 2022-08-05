<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\BaseModel;
use Inspirum\Balikobot\Client\Request\Version;
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
        private string $code,
        private string $name,
        private array $methods = [],
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

    public function getMethodsForVersion(Version $version): MethodCollection
    {
        return $this->methods[$version->getValue()];
    }

    /** @inheritDoc */
    public function __toArray(): array
    {
        return [
            'code'    => $this->code,
            'name'    => $this->name,
            'methods' => array_map(static fn(MethodCollection $methods) => $methods->__toArray(), $this->methods),
        ];
    }
}
