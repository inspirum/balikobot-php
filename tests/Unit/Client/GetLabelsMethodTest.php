<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class GetLabelsMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getLabels('cp', []);
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getLabels('cp', []);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status' => 400,
        ]);

        $client->getLabels('cp', []);
    }

    public function testMakeRequest()
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

        $this->assertTrue(true);
    }

    public function testOnlyLabelUrlIsReturned()
    {
        $client = $this->newMockedClient(200, [
            'status'     => 200,
            'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
        ]);

        $labelsUrl = $client->getLabels('cp', []);

        $this->assertEquals('https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.', $labelsUrl);
    }
}
