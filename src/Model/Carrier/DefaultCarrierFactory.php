<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Carrier;

use Inspirum\Balikobot\Client\Request\CarrierType;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Model\Method\MethodFactory;
use function array_filter;
use function array_map;

final class DefaultCarrierFactory implements CarrierFactory
{
    public function __construct(
        private MethodFactory $methodFactory
    ) {
    }

    /** @inheritDoc */
    public function create(CarrierType $carrier, array $data): Carrier
    {
        return new Carrier($carrier->getValue(), $data['name'], array_map(fn(array $methods) => $this->methodFactory->createCollection($methods), array_filter([
            Version::V2V1->getValue() => $data['methods'] ?? [],
            Version::V2V2->getValue() => $data['v2_methods'] ?? [],
        ])));
    }

    /** @inheritDoc */
    public function createCollection(array $data): CarrierCollection
    {
        return new CarrierCollection(
            array_map(fn(array $carrier): Carrier => $this->create(Carrier::from($carrier['slug']), $carrier), $data['carriers']),
        );
    }
}
