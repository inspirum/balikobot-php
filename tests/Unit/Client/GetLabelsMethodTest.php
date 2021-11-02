<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetLabelsMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getLabels('cp', []);
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getLabels('cp', []);
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getLabels('cp', []);
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'     => 200,
            'labels_url' => 'http://pdf.balikobot.cz/dpd/eNorMdY1NFwwXDAELgE2',
        ]);

        $client = new Client($requester);

        $client->getLabels('cp', ['1', '7', '876']);

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/cp/labels', ['package_ids' => ['1', '7', '876']]]
        );

        self::assertTrue(true);
    }

    public function testOnlyLabelUrlIsReturned(): void
    {
        $client = $this->newMockedClient(200, [
            'status'     => 200,
            'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
        ]);

        $labelsUrl = $client->getLabels('cp', []);

        self::assertEquals('https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.', $labelsUrl);
    }
}
