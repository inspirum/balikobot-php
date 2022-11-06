<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\OrderedShipment;

final class DefaultOrderedShipmentFactory implements OrderedShipmentFactory
{
    /** @inheritDoc */
    public function create(string $carrier, array $packageIds, array $data): OrderedShipment
    {
        return new DefaultOrderedShipment(
            $data['order_id'],
            $carrier,
            $packageIds,
            $data['handover_url'],
            $data['labels_url'],
            $data['file_url'] ?? null,
        );
    }
}
