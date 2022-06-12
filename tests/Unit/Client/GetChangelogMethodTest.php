<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;

class GetChangelogMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getChangelog();
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getChangelog();
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'                  => 400,
            'api_v1_documentation_cz' => 'https://balikobot.docs.apiary.io/',
            'api_v2_documentation_cz' => 'https://balikobotv2.docs.apiary.io/',
            'api_v1_documentation_en' => 'https://balikoboteng.docs.apiary.io/',
            'api_v2_documentation_en' => 'https://balikobotv2eng.docs.apiary.io/',
            'version'                 => '1.900',
            'date'                    => '2020-12-18',
            'versions'                => [],
        ]);

        $client->getChangelog();
    }

    public function testMakeRequest(): void
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
        ], [
            'https://apiv2.balikobot.cz/changelog',
            [],
        ]);

        $client = new Client($requester);

        $client->getChangelog();

        self::assertTrue(true);
    }
}
