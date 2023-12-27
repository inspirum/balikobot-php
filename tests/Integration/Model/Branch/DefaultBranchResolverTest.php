<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Country;
use Inspirum\Balikobot\Definitions\Service;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Exception\Exception;
use Inspirum\Balikobot\Model\Branch\BranchResolver;
use Inspirum\Balikobot\Model\Branch\DefaultBranchResolver;
use PHPUnit\Framework\Attributes\DataProvider;
use function count;
use function in_array;
use function iterator_to_array;
use function sprintf;
use function str_contains;
use function strtoupper;

final class DefaultBranchResolverTest extends BaseTestCase
{
    #[DataProvider('providesCarrierServiceData')]
    public function testHasFullBranchesSupport(string $carrier, string $service): void
    {
        $branchResolver = new DefaultBranchResolver();

        $mockedBranchResolver = $this->createMock(BranchResolver::class);
        $mockedBranchResolver->expects(self::any())->method('hasFullBranchesSupport')->willReturn(true);
        $branchService = $this->newDefaultBranchService($mockedBranchResolver);

        try {
            $branches = $branchService->getBranchesForCarrierService($carrier, $service);
            $branches->next();
            if ($branches->valid() === false) {
                self::markTestSkipped();
            }

            $shouldSupport = $branchResolver->hasFullBranchesSupport($carrier, $service);
            if ($shouldSupport === false) {
                self::markTestIncomplete(sprintf('%s/%s could support full-branches request', strtoupper($carrier), $service));
            } else {
                $this->assertNoException();
            }
        } catch (Exception $exception) {
            if ($exception->getStatusCode() === 503) {
                self::markTestIncomplete(sprintf('%s/%s is unavailable', strtoupper($carrier), $service));
            }

            self::assertFalse(
                $branchResolver->hasFullBranchesSupport($carrier, $service),
                sprintf(
                    '%s/%s: %s',
                    $carrier,
                    $service,
                    $exception->getMessage(),
                ),
            );
        }
    }

    #[DataProvider('providesCarrierServiceData')]
    public function testHasBranchCountryFilterSupport(string $carrier, string $service): void
    {
        $branchResolver = new DefaultBranchResolver();

        $mockedBranchResolver = $this->createMock(BranchResolver::class);
        $mockedBranchResolver->expects(self::any())->method('hasBranchCountryFilterSupport')->willReturn(true);
        $branchService = $this->newDefaultBranchService($mockedBranchResolver);

        $countries = [Country::CZECH_REPUBLIC, 'EE'];

        try {
            $branches = $branchService->getBranchesForCarrierService($carrier, $service);
            $branches->next();
            if ($branches->valid() === false) {
                self::markTestSkipped();
            }

            $totalCount = 0;
            foreach ($countries as $country) {
                $branches    = iterator_to_array($branchService->getBranchesForCarrierServiceAndCountries($carrier, $service, [$country]));
                $totalCount += count($branches);
                foreach ($branches as $branch) {
                    if ($branch->getCountry() !== $country) {
                        throw new BadRequestException([]);
                    }
                }
            }

            $shouldSupport = $branchResolver->hasBranchCountryFilterSupport($carrier, $service);
            if ($shouldSupport === false && $totalCount === 0) {
                self::markTestIncomplete(sprintf('%s/%s could support branch country filter', strtoupper($carrier), $service));
            } else {
                self::assertTrue($shouldSupport, sprintf('%s/%s should not support branch country filter', strtoupper($carrier), $service));
            }
        } catch (Exception $exception) {
            if ($exception->getStatusCode() === 503) {
                self::markTestIncomplete(sprintf('%s/%s is unavailable', strtoupper($carrier), $service));
            }

            self::assertFalse(
                $branchResolver->hasBranchCountryFilterSupport($carrier, $service),
                sprintf(
                    '%s/%s: %s',
                    $carrier,
                    $service,
                    $exception->getMessage(),
                ),
            );
        }
    }

    /**
     * @return iterable<array<string,string>>
     */
    public static function providesCarrierServiceData(): iterable
    {
        foreach (Carrier::getAll() as $carrier) {
            foreach (Service::getForCarrier($carrier) ?? [] as $service) {
                yield sprintf('%s-%s', $carrier, $service) => [
                    'carrier' => $carrier,
                    'service' => $service,
                ];
            }
        }
    }

    public function testBranchesFilterByCountryCodes(): void
    {
        $branchService = $this->newDefaultBranchService();
        $carriers      = Carrier::getAll();
        $countries     = [Country::SLOVAKIA, Country::GERMANY];

        foreach ($carriers as $carrier) {
            try {
                $branches = $branchService->getBranchesForCarrierAndCountries($carrier, $countries);
                foreach ($branches as $branch) {
                    self::assertNotNull($branch->getId());
                    self::assertTrue(
                        in_array($branch->getCountry(), $countries),
                        sprintf('Country %s code should be DE/SK', $branch->getCountry() ?? '[null]'),
                    );

                    break;
                }
            } catch (Exception $exception) {
                if ($exception->getStatusCode() === 501 || $exception->getStatusCode() === 503) {
                    self::markTestIncomplete(sprintf('%s is unavailable', strtoupper($carrier)));
                }

                $errorMessage = $exception->getResponse()['status_message'] ?? '';
                if (str_contains($errorMessage, 'Neznámý kód služby') === false) {
                    $this->fail(sprintf('%s: %s', strtoupper($carrier), $exception->getMessage()));
                }
            }
        }
    }
}
