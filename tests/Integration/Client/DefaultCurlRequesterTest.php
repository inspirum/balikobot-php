<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Client;

use Inspirum\Balikobot\Definitions\RequestType;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Tests\Integration\BaseTestCase;
use function json_decode;
use function sprintf;

class DefaultCurlRequesterTest extends BaseTestCase
{
    public function testSSLVerificationIsNotNeeded(): void
    {
        $url = sprintf('%s/%s', VersionType::V2V1->getValue(), RequestType::CHANGELOG->getValue());

        $requesterWithSSL = $this->newDefaultCurlRequester(false);
        $firstVersion     = json_decode($requesterWithSSL->request($url)->getBody()->getContents(), true)['version'];

        $requesterWithoutSSL = $this->newDefaultCurlRequester(true);
        $secondVersion       = json_decode($requesterWithoutSSL->request($url)->getBody()->getContents(), true)['version'];

        self::assertEquals($firstVersion, $secondVersion);
    }
}
