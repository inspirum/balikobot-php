<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Label;

final class DefaultLabelFactory implements LabelFactory
{
    /** @inheritDoc */
    public function create(array $data): string
    {
        return $data['labels_url'];
    }
}
