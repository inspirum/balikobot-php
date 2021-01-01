<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class LabelsRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getLabels('cp', []);
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->getLabels('cp', []);
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
        ]);

        $client = new Client($requester);

        $client->getLabels('cp', []);
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'     => 200,
            'labels_url' => 'http://pdf.balikobot.cz/dpd/eNorMdY1NFwwXDAELgE2',
        ]);

        $client = new Client($requester);

        $client->getLabels('cp', [1, 7, 876]);

        $requester->shouldHaveReceived(
            'request',
            ['https://api.balikobot.cz/cp/labels', ['package_ids' => [1, 7, 876]]]
        );

        $this->assertTrue(true);
    }

    public function testOnlyLabelUrlIsReturned()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'     => 200,
            'labels_url' => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
        ]);

        $client = new Client($requester);

        $labelsUrl = $client->getLabels('cp', []);

        $this->assertEquals('https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.', $labelsUrl);
    }
}
