<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration\Balikobot;

class GetAccountInfoMethodTest extends AbstractBalikobotTestCase
{
    public function testValidRequest(): void
    {
        $service = $this->newBalikobot();

        $info = $service->getAccountInfo();

        self::assertNotEmpty($info['account']);
        self::assertIsBool($info['live_account']);
        self::assertNotEmpty($info['carriers']);
    }
}
