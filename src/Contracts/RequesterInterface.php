<?php

namespace Inspirum\Balikobot\Contracts;

use Psr\Http\Message\ResponseInterface;

interface RequesterInterface
{
    /**
     * Call API
     *
     * @param string $version
     * @param string $request
     * @param string $shipper
     * @param array  $data
     * @param bool   $shouldHaveStatus
     *
     * @return array
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function call(
        string $version,
        string $shipper,
        string $request,
        array $data = [],
        bool $shouldHaveStatus = true
    ): array;

    /**
     * Get API response
     *
     * @param string $url
     * @param array  $data
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $url, array $data = []): ResponseInterface;
}
