<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Exception;

use Throwable;

final class UnauthorizedException extends BaseException
{
    /**
     * UnauthorizedException constructor
     */
    public function __construct(?string $message = null, int $statusCode = 401, ?Throwable $previous = null)
    {
        parent::__construct([], $statusCode, $previous, $message);
    }
}
