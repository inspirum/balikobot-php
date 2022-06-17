<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Client\CurlRequester;
use Inspirum\Balikobot\Tests\BaseTestCase;
use RuntimeException;

class CurlRequesterTest extends BaseTestCase
{
    public function testThrowsErrorOnRequestError(): void
    {
        $this->expectException(RuntimeException::class);

        $requester = new CurlRequester('test', 'test');

        $requester->request('dummy');
    }
}
