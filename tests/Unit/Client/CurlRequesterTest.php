<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Client\DefaultCurlRequester;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Exception\TransportException;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class CurlRequesterTest extends BaseTestCase
{
    public function testThrowsErrorOnRequestError(): void
    {
        $this->expectException(TransportException::class);
        $this->expectExceptionMessageMatches('/^cURL error \d+: /');

        $requester = new DefaultCurlRequester('test', 'test');

        $requester->request('dummy', ['test' => true]);
    }

    public function testThrowsErrorOnInvalidRequestData(): void
    {
        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage('Cannot encode request data');

        $requester = new DefaultCurlRequester('test', 'test');

        $requester->request('dummy', ['name' => "\xB1"]);
    }
}
