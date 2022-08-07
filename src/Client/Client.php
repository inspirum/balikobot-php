<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client;

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
        string $baseUrl,
        ?string $carrier,
        string $method,
        array $data = [],
        ?string $path = null,
        bool $shouldHaveStatus = true,
        bool $gzip = false,
    ): array;
}
