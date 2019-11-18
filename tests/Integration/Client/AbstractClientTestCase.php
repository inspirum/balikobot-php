<?php

namespace Inspirum\Balikobot\Tests\Integration\Client;

use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Services\Requester;
use Inspirum\Balikobot\Tests\AbstractTestCase;

abstract class AbstractClientTestCase extends AbstractTestCase
{
    /**
     * Get Balikobot API client instance.
     *
     * @param string|null $apiUser
     * @param string|null $apiKey
     *
     * @return \Inspirum\Balikobot\Services\Client
     */
    protected function newClient(string $apiUser = null, string $apiKey = null): Client
    {
        return new Client(
            new Requester(
                $apiUser ?: getenv('BALIKOBOT_API_USER'),
                $apiKey ?: getenv('BALIKOBOT_API_KEY')
            )
        );
    }
}
