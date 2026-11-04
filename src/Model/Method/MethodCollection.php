<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

use Inspirum\Arrayable\ListCollection;

/**
 * @extends \Inspirum\Arrayable\ListCollection<string,mixed,\Inspirum\Balikobot\Model\Method\Method>
 */
interface MethodCollection extends ListCollection
{
    /**
     * @return list<\Inspirum\Balikobot\Model\Method\Method>
     */
    public function getMethods(): array;
}
