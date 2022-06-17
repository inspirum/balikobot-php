<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Client;

use Inspirum\Balikobot\Client\CurlRequester;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Tests\BaseTestCase;
use function getenv;
use function json_decode;
use function sprintf;

class CurlRequesterTest extends BaseTestCase
{
    public function testSSLVerificationIsNotNeeded(): void
    {
        $apiUser = (string) getenv('BALIKOBOT_API_USER');
        $apiKey  = (string) getenv('BALIKOBOT_API_KEY');
        $url     = sprintf('%s/%s', Version::V2V1, Request::CHANGELOG);

        $requesterWithSSL = new CurlRequester($apiUser, $apiKey, sslVerify: false);
        $firstVersion     = json_decode($requesterWithSSL->request($url)->getBody()->getContents(), true)['version'];

        $requesterWithoutSSL = new CurlRequester($apiUser, $apiKey, sslVerify: true);
        $secondVersion       = json_decode($requesterWithoutSSL->request($url)->getBody()->getContents(), true)['version'];

        self::assertEquals($firstVersion, $secondVersion);
    }
}
