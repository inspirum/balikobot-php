<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Arrayable\Model;
use Inspirum\Balikobot\Client\Request\Version;
use Inspirum\Balikobot\Model\Method\MethodCollection;

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

    public function getMethodsForVersion(Version $version): MethodCollection;
}
