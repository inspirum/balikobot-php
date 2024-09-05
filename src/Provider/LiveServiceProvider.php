<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Provider;

use Inspirum\Balikobot\Model\Service\Service;
use Inspirum\Balikobot\Service\SettingService;
use function array_map;

final class LiveServiceProvider implements ServiceProvider
{
    public function __construct(
        private readonly SettingService $settingService,
    ) {
    }

    /**
     * @return list<string>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function getServices(string $carrier): array
    {
        return array_map(static fn (Service $service): string => $service->getType(), $this->settingService->getServices($carrier)->getServices());
    }
}
