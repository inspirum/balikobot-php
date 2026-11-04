<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

use Inspirum\Arrayable\BaseListCollection;

/**
 * @extends \Inspirum\Arrayable\BaseListCollection<string,mixed,\Inspirum\Balikobot\Model\Method\Method>
 */
final class DefaultMethodCollection extends BaseListCollection implements MethodCollection
{
    /** @inheritDoc */
    public function getMethods(): array
    {
        return $this->getItems();
    }
}
