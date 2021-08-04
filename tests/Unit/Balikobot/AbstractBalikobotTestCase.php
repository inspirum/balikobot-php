<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;
use Inspirum\Balikobot\Tests\AbstractTestCase;

abstract class AbstractBalikobotTestCase extends AbstractTestCase
{
    /**
     * Get client with partial mocked API requester instance with overridden call method.
     *
     * @param int                 $statusCode
     * @param array<mixed>|string $data
     *
     * @return \Inspirum\Balikobot\Services\Balikobot
     */
    public function newMockedBalikobot(int $statusCode, $data): Balikobot
    {
        return new Balikobot($this->newRequesterWithMockedRequestMethod($statusCode, $data));
    }
}
