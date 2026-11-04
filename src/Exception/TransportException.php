<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Exception;

use Throwable;

final class TransportException extends BaseException
{
    /**
     * TransportException constructor
     */
    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct([], 0, $previous, $message);
    }
}
