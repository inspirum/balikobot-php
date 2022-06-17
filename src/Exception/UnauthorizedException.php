<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Exception;

use Throwable;

class UnauthorizedException extends BaseException
{
    /**
     * UnauthorizedException constructor
     *
     * @param string|null     $message
     * @param int             $statusCode
     * @param \Throwable|null $previous
     */
    public function __construct(?string $message = null, int $statusCode = 401, ?Throwable $previous = null)
    {
        parent::__construct([], $statusCode, $previous, $message);
    }
}
