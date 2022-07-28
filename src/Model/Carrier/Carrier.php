<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\Model;
use Inspirum\Balikobot\Client\Request\Version;

/**
 * @extends \Inspirum\Arrayable\Model<string,mixed>
 */
interface Carrier extends Model
{
    public function getCode(): string;

    public function getName(): string;

    /**
     * @return array<string,\Inspirum\Balikobot\Model\Method\MethodCollection>
     */
    public function getMethods(): array;

    /**
     * @return array<array<string,string>>
     */
    public function getMethodsForVersion(Version $version): array;
}
