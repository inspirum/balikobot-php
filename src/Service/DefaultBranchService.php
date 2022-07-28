<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\RequestType;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Branch\BranchFactory;
use Inspirum\Balikobot\Model\Branch\BranchResolver;
use Inspirum\Balikobot\Provider\CarrierProvider;
use Inspirum\Balikobot\Provider\ServiceProvider;
use Traversable;
use function array_filter;
use function implode;
use function in_array;

final class DefaultBranchService implements BranchService
{
    public function __construct(
        private Client $client,
        private BranchFactory $branchFactory,
        private BranchResolver $branchResolver,
        private CarrierProvider $carrierProvider,
        private ServiceProvider $serviceProvider,
    ) {
    }

    /** @inheritDoc */
    public function getBranches(): Traversable
    {
        foreach ($this->carrierProvider->getCarriers() as $carrier) {
            foreach ($this->getBranchesForCarrier($carrier) as $branch) {
                yield $branch;
            }
        }
    }

    /** @inheritDoc */
    public function getBranchesForCountries(array $countries): Traversable
    {
        foreach ($this->carrierProvider->getCarriers() as $carrier) {
            foreach ($this->getBranchesForCarrierAndCountries($carrier, $countries) as $branch) {
                yield $branch;
            }
        }
    }

    /** @inheritDoc */
    public function getBranchesForCarrier(string $carrier): Traversable
    {
        foreach ($this->serviceProvider->getServices($carrier) as $service) {
            foreach ($this->loadBranchesForCarrierServiceAndCountry($carrier, $service, null) as $branch) {
                yield $branch;
            }
        }
    }

    /** @inheritDoc */
    public function getBranchesForCarrierAndCountries(string $carrier, array $countries): Traversable
    {
        foreach ($this->serviceProvider->getServices($carrier) as $service) {
            foreach ($this->getBranchesForCarrierServiceAndCountries($carrier, $service, $countries) as $branch) {
                yield $branch;
            }
        }
    }

    /** @inheritDoc */
    public function getBranchesForCarrierService(string $carrier, ?string $service): Traversable
    {
        return $this->loadBranchesForCarrierServiceAndCountry($carrier, $service, null);
    }

    /** @inheritDoc */
    public function getBranchesForCarrierServiceAndCountries(string $carrier, ?string $service, array $countries): Traversable
    {
        foreach ($this->loadBranchesForCarrierServiceAndCountries($carrier, $service, $countries) as $branch) {
            if (in_array($branch->getCountry(), $countries, true)) {
                yield $branch;
            }
        }
    }

    /**
     * @param array<string> $countries
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    private function loadBranchesForCarrierServiceAndCountries(string $carrier, ?string $service, array $countries): Traversable
    {
        if ($this->branchResolver->hasBranchCountryFilterSupport($carrier, $service) === false) {
            return yield from $this->loadBranchesForCarrierServiceAndCountry($carrier, $service, null);
        }

        foreach ($countries as $country) {
            yield from $this->loadBranchesForCarrierServiceAndCountry($carrier, $service, $country);
        }
    }

    /**
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    private function loadBranchesForCarrierServiceAndCountry(string $carrier, ?string $service, ?string $country): Traversable
    {
        $usedRequest = $this->branchResolver->hasFullBranchesSupport($carrier, $service) ? RequestType::FULL_BRANCHES : RequestType::BRANCHES;

        $paths = [];
        if ($service !== null) {
            $paths[] = 'service';
            $paths[] = $service;
        }

        if ($country !== null) {
            $paths[] = 'country';
            $paths[] = $country;
        }

        $response = $this->client->call(VersionType::V2V1, $carrier, $usedRequest, path: implode('/', $paths), gzip: true);

        return $this->branchFactory->createIterator($carrier, $service, $response);
    }

    /** @inheritDoc */
    public function getBranchesForLocation(
        string $carrier,
        string $country,
        string $city,
        ?string $zipCode = null,
        ?string $street = null,
        ?int $maxResults = null,
        ?float $radius = null,
        ?string $type = null,
    ): Traversable {
        $response = $this->client->call(
            VersionType::V2V1,
            $carrier,
            RequestType::BRANCH_LOCATOR,
            array_filter(
                [
                    'country'     => $country,
                    'city'        => $city,
                    'zip'         => $zipCode,
                    'street'      => $street,
                    'max_results' => $maxResults,
                    'radius'      => $radius,
                    'type'        => $type,
                ]
            )
        );

        return $this->branchFactory->createIterator($carrier, null, $response);
    }
}
