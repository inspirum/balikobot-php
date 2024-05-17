<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Client;

use Inspirum\Balikobot\Definitions\Method;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Tests\Integration\BaseTestCase;
use function json_decode;
use function sprintf;

final class DefaultCurlRequesterTest extends BaseTestCase
{
    public function testSSLVerificationIsNotNeeded(): void
    {
        $url = sprintf('%s/%s', Version::V2V1, Method::CHANGELOG);

        $requesterWithSSL = $this->newDefaultCurlRequester(false);
        $firstVersion = json_decode($requesterWithSSL->request($url)->getBody()->getContents(), true)['version'];

        $requesterWithoutSSL = $this->newDefaultCurlRequester(true);
        $secondVersion = json_decode($requesterWithoutSSL->request($url)->getBody()->getContents(), true)['version'];

        self::assertEquals($firstVersion, $secondVersion);
    }
}
