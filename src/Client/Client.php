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
     * @return array<mixed,mixed>
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function call(
        string $version,
        ?string $carrier,
        string $request,
        array $data = [],
        string $path = '',
        bool $shouldHaveStatus = true,
        bool $gzip = false,
    ): array;
}
