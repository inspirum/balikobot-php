<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Account;

interface AccountFactory
{
    /**
     * @param array<string,mixed> $response
     */
    public function create(array $response): Account;
}
