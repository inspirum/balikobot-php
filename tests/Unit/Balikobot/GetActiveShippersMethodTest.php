<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Inspirum\Balikobot\Services\Balikobot;

class GetActiveShippersMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 200,
            'carriers'  => [],
        ]);

        $service = new Balikobot($requester);

        $service->getActiveShippers();

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/carriers/my',
                [],
            ],
        );

        self::assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status' => 200,
            'carriers'      => [
                'cp',
                'ppl',
                'dpd',
                'geis',
                'gls',
            ],
        ]);

        $units = $service->getActiveShippers();

        self::assertEquals(
            [
                'cp',
                'ppl',
                'dpd',
                'geis',
                'gls',
            ],
            $units,
        );
    }
}
