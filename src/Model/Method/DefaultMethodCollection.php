<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

use Inspirum\Arrayable\BaseCollection;

/**
 * @extends \Inspirum\Arrayable\BaseCollection<string,mixed,int,\Inspirum\Balikobot\Model\Method\Method>
 */
final class DefaultMethodCollection extends BaseCollection implements MethodCollection
{
    /** @inheritDoc */
    public function getMethods(): array
    {
        return $this->getItems();
    }
}
