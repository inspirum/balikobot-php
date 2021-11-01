<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use Inspirum\Balikobot\Definitions\API;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Services\Requester;
use Inspirum\Balikobot\Tests\AbstractTestCase;
use function getenv;

class RequesterTest extends AbstractTestCase
{
    public function testSSLVerificationIsNotNeeded(): void
    {
        $requesterWithSSL = new Requester((string) getenv('BALIKOBOT_API_USER'), (string) getenv('BALIKOBOT_API_KEY'), sslVerify: false);
        $firstVersion     = $requesterWithSSL->call(API::V2V1, '', Request::CHANGELOG)['version'];

        $requesterWithoutSSL = new Requester((string) getenv('BALIKOBOT_API_USER'), (string) getenv('BALIKOBOT_API_KEY'), sslVerify: true);
        $secondVersion       = $requesterWithoutSSL->call(API::V2V1, '', Request::CHANGELOG)['version'];

        self::assertEquals($firstVersion, $secondVersion);
    }
}
