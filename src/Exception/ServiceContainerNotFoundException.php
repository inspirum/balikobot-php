<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Exception;

use InvalidArgumentException;
use function implode;
use function sprintf;

class ServiceContainerNotFoundException extends InvalidArgumentException
{
    /**
     * @param array<string> $alternatives
     */
    public function __construct(string $connection, array $alternatives)
    {
        parent::__construct(sprintf('Service container for "%s" connection is not available in "%s" values.', $connection, implode(',', $alternatives)));
    }
}
