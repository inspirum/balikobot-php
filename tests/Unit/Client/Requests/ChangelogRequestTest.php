<?php

namespace Inspirum\Balikobot\Tests\Unit\Client\Request;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class ChangelogRequestTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(400, [
            'status' => 200,
        ]);

        $client = new Client($requester);

        $client->getChangelog();
    }

    public function testRequestShouldHaveStatus()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, []);

        $client = new Client($requester);

        $client->getChangelog();
    }

    public function testThrowsExceptionOnBadStatusCode()
    {
        $this->expectException(BadRequestException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'                  => 400,
            'api_v1_documentation_cz' => 'https://balikobot.docs.apiary.io/',
            'api_v2_documentation_cz' => 'https://balikobotv2.docs.apiary.io/',
            'api_v1_documentation_en' => 'https://balikoboteng.docs.apiary.io/',
            'api_v2_documentation_en' => 'https://balikobotv2eng.docs.apiary.io/',
            'version'                 => '1.900',
            'date'                    => '2020-12-18',
            'versions'                => [],
        ]);

        $client = new Client($requester);

        $client->getChangelog();
    }

    public function testMakeRequest()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'                  => 200,
            'api_v1_documentation_cz' => 'https://balikobot.docs.apiary.io/',
            'api_v2_documentation_cz' => 'https://balikobotv2.docs.apiary.io/',
            'api_v1_documentation_en' => 'https://balikoboteng.docs.apiary.io/',
            'api_v2_documentation_en' => 'https://balikobotv2eng.docs.apiary.io/',
            'version'                 => '1.900',
            'date'                    => '2020-12-18',
            'versions'                => [
                0 => [
                    'version' => '1.900',
                    'date'    => '2020-12-18',
                    'changes' => [
                        0 => [
                            'name'        => 'ADD Zásilkovna',
                            'description' => '- delivery_costs a delivery_costs_eur - přidání GB',
                        ],
                        1 => [
                            'name'        => 'ADD PbH',
                            'description' => '- content data - přidání GB',
                        ],
                    ],
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->getChangelog();

        $requester->shouldHaveReceived(
            'request',
            ['https://api.balikobot.cz/changelog', []]
        );

        $this->assertTrue(true);
    }
}
