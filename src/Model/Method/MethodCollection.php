<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

use Inspirum\Arrayable\Collection;

/**
 * @extends \Inspirum\Arrayable\Collection<string,mixed,int,\Inspirum\Balikobot\Model\Method\Method>
 */
interface MethodCollection extends Collection
{
    /**
     * @return array<int,\Inspirum\Balikobot\Model\Method\Method>
     */
    public function getMethods(): array;
}
