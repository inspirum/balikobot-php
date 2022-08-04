<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Provider;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrier;
use Inspirum\Balikobot\Model\Carrier\DefaultCarrierCollection;
use Inspirum\Balikobot\Provider\LiveCarrierProvider;
use Inspirum\Balikobot\Service\InfoService;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use function array_map;

final class LiveCarrierProviderTest extends BaseTestCase
{
    public function testGetCarriers(): void
    {
        $expectedCarriers = [
            Carrier::DPD,
            Carrier::SP,
            Carrier::MAGYARPOSTA,
        ];

        $infoService = $this->createMock(InfoService::class);
        $infoService->expects(self::once())->method('getCarriers')->willReturn(
            new DefaultCarrierCollection(array_map(static fn(string $carrier): DefaultCarrier => new DefaultCarrier($carrier, $carrier), $expectedCarriers)),
        );

        $provider = $this->newLiveCarrierProvider($infoService);

        $carriers = $provider->getCarriers();

        self::assertSame($expectedCarriers, $carriers);
    }

    private function newLiveCarrierProvider(InfoService $infoService): LiveCarrierProvider
    {
        return new LiveCarrierProvider($infoService);
    }
}
