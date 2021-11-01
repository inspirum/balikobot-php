<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;
use Inspirum\Balikobot\Services\Requester;
use Inspirum\Balikobot\Tests\AbstractTestCase;
use function getenv;

abstract class AbstractBalikobotTestCase extends AbstractTestCase
{
    /**
     * Get Balikobot API client instance.
     *
     * @param string|null $apiUser
     * @param string|null $apiKey
     *
     * @return \Inspirum\Balikobot\Services\Balikobot
     */
    protected function newBalikobot(?string $apiUser = null, ?string $apiKey = null): Balikobot
    {
        return new Balikobot(
            new Requester(
                $apiUser ?? (string) getenv('BALIKOBOT_API_USER'),
                $apiKey ?? (string) getenv('BALIKOBOT_API_KEY')
            )
        );
    }
}
