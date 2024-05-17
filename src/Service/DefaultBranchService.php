<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Service;

use Inspirum\Balikobot\Client\Client;
use Inspirum\Balikobot\Definitions\Method;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Model\Branch\BranchFactory;
use Inspirum\Balikobot\Model\Branch\BranchIterator;
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
        private readonly Client $client,
        private readonly BranchFactory $branchFactory,
        private readonly BranchResolver $branchResolver,
        private readonly CarrierProvider $carrierProvider,
        private readonly ServiceProvider $serviceProvider,
    ) {
    }

    public function getBranches(): BranchIterator
    {
        return $this->branchFactory->wrapIterator(null, null, null, $this->generateBranches());
    }

    /**
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    private function generateBranches(): Traversable
    {
        foreach ($this->carrierProvider->getCarriers() as $carrier) {
            foreach ($this->getBranchesForCarrier($carrier) as $branch) {
                yield $branch;
            }
        }
    }

    /** @inheritDoc */
    public function getBranchesForCountries(array $countries): BranchIterator
    {
        return $this->branchFactory->wrapIterator(null, null, $countries, $this->generateBranchesForCountries($countries));
    }

    /**
     * @param array<string> $countries
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    private function generateBranchesForCountries(array $countries): Traversable
    {
        foreach ($this->carrierProvider->getCarriers() as $carrier) {
            foreach ($this->getBranchesForCarrierAndCountries($carrier, $countries) as $branch) {
                yield $branch;
            }
        }
    }

    public function getBranchesForCarrier(string $carrier): BranchIterator
    {
        return $this->branchFactory->wrapIterator($carrier, null, null, $this->generateBranchesForCarrier($carrier));
    }

    /**
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    private function generateBranchesForCarrier(string $carrier): Traversable
    {
        foreach ($this->serviceProvider->getServices($carrier) as $service) {
            foreach ($this->getBranchesForCarrierServiceAndCountry($carrier, $service, null) as $branch) {
                yield $branch;
            }
        }
    }

    /** @inheritDoc */
    public function getBranchesForCarrierAndCountries(string $carrier, array $countries): BranchIterator
    {
        return $this->branchFactory->wrapIterator($carrier, null, $countries, $this->generateBranchesForCarrierAndCountries($carrier, $countries));
    }

    /**
     * @param array<string> $countries
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    private function generateBranchesForCarrierAndCountries(string $carrier, array $countries): Traversable
    {
        foreach ($this->serviceProvider->getServices($carrier) as $service) {
            foreach ($this->getBranchesForCarrierServiceAndCountries($carrier, $service, $countries) as $branch) {
                yield $branch;
            }
        }
    }

    public function getBranchesForCarrierService(string $carrier, string $service): BranchIterator
    {
        return $this->getBranchesForCarrierServiceAndCountry($carrier, $service, null);
    }

    /** @inheritDoc */
    public function getBranchesForCarrierServiceAndCountries(string $carrier, string $service, array $countries): BranchIterator
    {
        return $this->branchFactory->wrapIterator($carrier, $service, $countries, $this->generateBranchesForCarrierServiceAndCountries($carrier, $service, $countries));
    }

    /**
     * @param array<string> $countries
     *
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    private function generateBranchesForCarrierServiceAndCountries(string $carrier, ?string $service, array $countries): Traversable
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
     * @return \Traversable<\Inspirum\Balikobot\Model\Branch\Branch>&iterable<\Inspirum\Balikobot\Model\Branch\Branch>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    private function loadBranchesForCarrierServiceAndCountries(string $carrier, ?string $service, array $countries): Traversable
    {
        if ($this->branchResolver->hasBranchCountryFilterSupport($carrier, $service) === false) {
            return yield from $this->getBranchesForCarrierServiceAndCountry($carrier, $service, null);
        }

        foreach ($countries as $country) {
            yield from $this->getBranchesForCarrierServiceAndCountry($carrier, $service, $country);
        }
    }

    /**
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    private function getBranchesForCarrierServiceAndCountry(string $carrier, ?string $service, ?string $country): BranchIterator
    {
        $usedRequest = $this->branchResolver->hasFullBranchesSupport($carrier, $service) ? Method::FULL_BRANCHES : Method::BRANCHES;

        $paths = [];
        if ($service !== null) {
            $paths[] = 'service';
            $paths[] = $service;
        }

        if ($country !== null) {
            $paths[] = 'country';
            $paths[] = $country;
        }

        $response = $this->client->call(Version::V2V1, $carrier, $usedRequest, path: implode('/', $paths), gzip: true);

        return $this->branchFactory->createIterator($carrier, $service, $country !== null ? [$country] : null, $response);
    }

    public function getBranchesForLocation(
        string $carrier,
        string $country,
        string $city,
        ?string $zipCode = null,
        ?string $street = null,
        ?int $maxResults = null,
        ?float $radius = null,
        ?string $type = null,
    ): BranchIterator {
        $response = $this->client->call(
            Version::V2V1,
            $carrier,
            Method::BRANCH_LOCATOR,
            array_filter(
                [
                    'country' => $country,
                    'city' => $city,
                    'zip' => $zipCode,
                    'street' => $street,
                    'max_results' => $maxResults,
                    'radius' => $radius,
                    'type' => $type,
                ],
            ),
        );

        return $this->branchFactory->createIterator($carrier, null, [$country], $response);
    }
}
