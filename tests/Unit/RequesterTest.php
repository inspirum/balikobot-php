<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Services\Requester;
use Inspirum\Balikobot\Tests\AbstractTestCase;
use RuntimeException;

class RequesterTest extends AbstractTestCase
{
    public function testThrowsErrorOnRequestError(): void
    {
        $this->expectException(RuntimeException::class);

        $requester = new Requester('test', 'test');

        $requester->request('dummy');
    }
}
