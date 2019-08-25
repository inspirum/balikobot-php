<?php

namespace Inspirum\Balikobot\Contracts;

use Throwable;

interface ExceptionInterface extends Throwable
{
    /**
     * Get response HTTP status code
     *
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Get response as array
     *
     * @return array
     */
    public function getResponse(): array;

    /**
     * Get response as string
     *
     * @return string
     */
    public function getResponseAsString(): string;

    /**
     * Get response errors
     *
     * @return array
     */
    public function getErrors(): array;
}
