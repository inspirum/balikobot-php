<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use Inspirum\Balikobot\Services\Requester;
use Inspirum\Balikobot\Tests\AbstractTestCase;
use RuntimeException;
use function gzcompress;
use function json_encode;

class RequesterTest extends AbstractTestCase
{
    public function testThrowsErrorOnRequestError(): void
    {
        $this->expectException(RuntimeException::class);

        $requester = new Requester('test', 'test');

        $requester->request('dummy');
    }

    public function testStatusValidation(): void
    {
        $this->expectException(RuntimeException::class);

        $expected = [
            'status' => 200,
            'test'   => 1596,
        ];

        $requester = $this->newRequesterWithMockedRequestMethod(400, $expected);

        $requester->call('v1', 'cp', 'test', shouldHaveStatus: false);
    }

    public function testResponseStatusValidation(): void
    {
        $this->expectException(RuntimeException::class);

        $expected = [
            'status' => 400,
            'test'   => 1596,
        ];

        $requester = $this->newRequesterWithMockedRequestMethod(200, $expected);

        $requester->call('v1', 'cp', 'test', shouldHaveStatus: true);
    }

    public function testShouldHaveStatus(): void
    {
        $this->expectException(RuntimeException::class);

        $expected = [
            'test' => 1596,
        ];

        $requester = $this->newRequesterWithMockedRequestMethod(200, $expected);

        $requester->call('v1', 'cp', 'test', shouldHaveStatus: true);
    }

    public function testShouldHaveStatusFailed(): void
    {
        $expected = [
            'test' => 1596,
        ];

        $requester = $this->newRequesterWithMockedRequestMethod(200, $expected);

        $response = $requester->call('v1', 'cp', 'test', shouldHaveStatus: false);

        self::assertEquals($expected, $response);
    }

    public function testUncompressedData(): void
    {
        $expected = [
            'status' => 200,
            'test'   => 1596,
        ];

        $requester = $this->newRequesterWithMockedRequestMethod(200, $expected);

        $response = $requester->call('v1', 'zasilkovna', 'branches/service/VMCZ/country/CZ', gzip: false);

        self::assertEquals($expected, $response);
    }

    public function testCompressedData(): void
    {
        $expected   = [
            'status' => 200,
            'test'   => 1596,
        ];
        $compressed = (string) gzcompress((string) json_encode($expected));

        $requester = $this->newRequesterWithMockedRequestMethod(200, $compressed);

        $response = $requester->call('v1', 'zasilkovna', 'branches/service/VMCZ/country/CZ', gzip: true);

        self::assertEquals($expected, $response);
    }

    public function testCompressedDataFailed(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Cannot parse response data');

        $expected   = [
            'status' => 200,
            'test'   => 1596,
        ];
        $compressed = (string) gzcompress((string) json_encode($expected));

        $requester = $this->newRequesterWithMockedRequestMethod(200, $compressed);

        $requester->call('v1', 'zasilkovna', 'branches/service/VMCZ/country/CZ', gzip: false);
    }

    public function testCompressedDataFallback(): void
    {
        $expected = [
            'status' => 200,
            'test'   => 1596,
        ];

        $requester = $this->newRequesterWithMockedRequestMethod(200, $expected);

        $response = $requester->call('v1', 'zasilkovna', 'branches/service/VMCZ/country/CZ', gzip: true);

        self::assertEquals($expected, $response);
    }
}
