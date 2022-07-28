<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client;

use Inspirum\Balikobot\Client\Request\Method;
use Inspirum\Balikobot\Client\Request\Version;

interface Client
{
    /**
     * Call API server, parse and validate response data
     *
     * @param array<mixed,mixed> $data
     *
     * @return array<string,mixed>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function call(
        Version $version,
        ?string $carrier,
        Method $request,
        array $data = [],
        ?string $path = null,
        bool $shouldHaveStatus = true,
        bool $gzip = false,
    ): array;
}
