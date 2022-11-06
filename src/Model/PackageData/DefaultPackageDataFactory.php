<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\PackageData;

final class DefaultPackageDataFactory implements PackageDataFactory
{
    /**
     * @param array<string,mixed> $data
     */
    public function create(array $data): PackageData
    {
        unset(
            $data['package_id'],
            $data['eshop_id'],
            $data['carrier_id'],
            $data['track_url'],
            $data['label_url'],
            $data['carrier_id_swap'],
            $data['pieces'],
        );

        return new DefaultPackageData($data);
    }
}
