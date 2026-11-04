<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client\Response;

use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Exception\UnauthorizedException;
use function array_is_list;
use function count;
use function is_int;
use function is_string;
use function preg_match;

final class Validator
{
    /**
     * Validate status code
     *
     * @param array<mixed,mixed> $response
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function validateStatus(int $statusCode, array $response = []): void
    {
        // unauthorized
        if ($statusCode === 401 || $statusCode === 403) {
            throw new UnauthorizedException(null, $statusCode);
        }

        // request error
        if ($statusCode >= 400) {
            throw new BadRequestException($response, $statusCode);
        }
    }

    /**
     * Validate response item status
     *
     * @param array<mixed,mixed> $responseItem
     * @param array<mixed,mixed>|null $response
     *
     * @throws \Inspirum\Balikobot\Exception\Exception
     */
    public function validateResponseStatus(
        array $responseItem,
        ?array $response = null,
        bool $shouldHaveStatus = true,
        int $defaultStatusCode = 500,
    ): void {
        if ($shouldHaveStatus === false && isset($responseItem['status']) === false) {
            return;
        }

        $response ??= $responseItem;

        $this->validateStatus($this->resolveStatusCode($responseItem['status'] ?? $defaultStatusCode, $response), $response);
    }

    /**
     * @param array<mixed,mixed> $response
     *
     * @throws \Inspirum\Balikobot\Exception\BadRequestException
     */
    private function resolveStatusCode(mixed $status, array $response): int
    {
        if (is_string($status) && preg_match('/^\d+$/D', $status) === 1) {
            return (int) $status;
        }

        if (is_int($status)) {
            return $status;
        }

        throw new BadRequestException($response, message: 'Invalid response status');
    }

    /**
     * Validate that every response item has given attribute
     *
     * @param array<array<string,mixed>> $items
     * @param array<mixed,mixed> $response
     *
     * @throws \Inspirum\Balikobot\Exception\BadRequestException
     */
    public function validateResponseItemsHasAttribute(array $items, string $attribute, array $response): void
    {
        foreach ($items as $item) {
            $this->validateResponseItemHasAttribute($item, $attribute, $response);
        }
    }

    /**
     * Validate that response item has given attribute
     *
     * @param array<string,mixed> $item
     * @param array<mixed,mixed> $response
     *
     * @throws \Inspirum\Balikobot\Exception\BadRequestException
     */
    public function validateResponseItemHasAttribute(array $item, string $attribute, array $response): void
    {
        if (isset($item[$attribute]) === false) {
            throw new BadRequestException($response);
        }
    }

    /**
     * Validate that response item has some attributes
     *
     * @param array<string,mixed> $item
     * @param list<string> $attributes
     * @param array<mixed,mixed> $response
     *
     * @throws \Inspirum\Balikobot\Exception\BadRequestException
     */
    public function validateResponseItemHasSomeAttributes(array $item, array $attributes, array $response): void
    {
        foreach ($attributes as $attribute) {
            if (isset($item[$attribute])) {
                return;
            }
        }

        throw new BadRequestException($response);
    }

    /**
     * Validate response array has correct indexes
     *
     * @param array<mixed,mixed> $response
     *
     * @throws \Inspirum\Balikobot\Exception\BadRequestException
     */
    public function validateIndexes(array $response, int $count): void
    {
        if (array_is_list($response) === false || count($response) !== $count) {
            throw new BadRequestException($response);
        }
    }
}
