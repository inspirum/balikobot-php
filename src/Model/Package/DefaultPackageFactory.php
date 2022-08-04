<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Package;

use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Definitions\Option;
use function count;

final class DefaultPackageFactory implements PackageFactory
{
    public function __construct(
        private Validator $validator,
    ) {
    }

    /** @inheritDoc */
    public function create(string $carrier, array $data): Package
    {
        return new DefaultPackage(
            $carrier,
            (string) $data['package_id'],
            $data['eid'],
            (string) ($data['carrier_id'] ?? ''),
            $data['track_url'] ?? null,
            $data['label_url'] ?? null,
            $data['carrier_id_swap'] ?? null,
            $data['pieces'] ?? [],
            $data['carrier_id_final'] ?? null,
            $data['track_url_final'] ?? null
        );
    }

    /** @inheritDoc */
    public function createCollection(string $carrier, ?array $packages, array $data): PackageCollection
    {
        unset($data['status']);

        $packagesResponse = $data['packages'] ?? $data;
        if ($packages !== null) {
            $this->validator->validateIndexes($packagesResponse, count($packages));
        }

        $orderedPackages = new DefaultPackageCollection(
            $carrier,
            labelsUrl: $data['labels_url'] ?? null,
        );

        foreach ($packagesResponse as $i => $package) {
            $this->validator->validateResponseStatus($package, $data, false);

            $package[Option::EID] ??= $packages[$i][Option::EID] ?? null;

            $orderedPackages->add($this->create($carrier, $package));
        }

        return $orderedPackages;
    }
}
