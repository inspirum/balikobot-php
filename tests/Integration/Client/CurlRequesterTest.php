<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Client;

use Inspirum\Balikobot\Client\DefaultCurlRequester;
use Inspirum\Balikobot\Definitions\RequestType;
use Inspirum\Balikobot\Definitions\VersionType;
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
        $url     = sprintf('%s/%s', VersionType::V2V1->getValue(), RequestType::CHANGELOG->getValue());

        $requesterWithSSL = new DefaultCurlRequester($apiUser, $apiKey, sslVerify: false);
        $firstVersion     = json_decode($requesterWithSSL->request($url)->getBody()->getContents(), true)['version'];

        $requesterWithoutSSL = new DefaultCurlRequester($apiUser, $apiKey, sslVerify: true);
        $secondVersion       = json_decode($requesterWithoutSSL->request($url)->getBody()->getContents(), true)['version'];

        self::assertEquals($firstVersion, $secondVersion);
    }
}
