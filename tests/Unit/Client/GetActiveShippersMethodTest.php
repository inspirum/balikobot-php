<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client\Request;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class GetActiveShippersMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getActiveShippers();
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getActiveShippers();
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'       => 400,
            'carriers'      => [
                'cp',
                'ppl',
                'dpd',
                'geis',
                'gls',
            ],
        ]);

        $client->getActiveShippers();
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'carriers'      => [
                'cp',
                'ppl',
                'dpd',
                'geis',
                'gls',
            ],
        ]);

        $client = new Client($requester);

        $client->getActiveShippers();

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/carriers/my', []]
        );

        self::assertTrue(true);
    }

    public function testOnlyShippersAreReturned(): void
    {
        $client = $this->newMockedClient(200, [
            'status' => 200,
            'carriers'      => [
                'cp',
                'ppl',
                'dpd',
                'geis',
                'gls',
            ],
        ]);

        $shippers = $client->getActiveShippers();

        self::assertEquals(
            [
                'cp',
                'ppl',
                'dpd',
                'geis',
                'gls',
            ],
            $shippers,
        );
    }
}
