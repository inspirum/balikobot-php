<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\AbstractTestCase;

abstract class AbstractClientTestCase extends AbstractTestCase
{
    /**
     * Get client with partial mocked API requester instance with overridden call method.
     *
     * @param int                 $statusCode
     * @param array<mixed>|string $data
     *
     * @return \Inspirum\Balikobot\Services\Client
     */
    public function newMockedClient(int $statusCode, array|string $data): Client
    {
        return new Client($this->newRequesterWithMockedRequestMethod($statusCode, $data));
    }
}
