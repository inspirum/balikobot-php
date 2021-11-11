<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client\Request;

use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Services\Client;
use Inspirum\Balikobot\Tests\Unit\Client\AbstractClientTestCase;

class GetAccountInfoMethodTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(400, [
            'status' => 200,
        ]);

        $client->getAccountInfo();
    }

    public function testRequestShouldHaveStatus(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, []);

        $client->getAccountInfo();
    }

    public function testThrowsExceptionOnBadStatusCode(): void
    {
        $this->expectException(BadRequestException::class);

        $client = $this->newMockedClient(200, [
            'status'       => 400,
            'account'      => [
                'name'           => 'Balikobot-Test_obchod.cz',
                'contact_person' => 'DPD_2',
                'street'         => 'Kovářská 12',
                'city'           => 'Praha 9',
                'zip'            => '19000',
                'country'        => 'CZ',
                'email'          => 'info@balikobot.cz',
                'url'            => 'http://www.balikobot_test2.cz',
                'phone'          => '+420123456789',
            ],
            'live_account' => false,
            'carriers'     => [
                [
                    'name' => 'Česká pošta',
                    'slug' => 'cp',
                ],
                [
                    'name' => 'PPL',
                    'slug' => 'ppl',
                ],
                [
                    'name' => 'DPD',
                    'slug' => 'dpd',
                ],
            ],
        ]);

        $client->getAccountInfo();
    }

    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'       => 200,
            'account'      => [
                'name'           => 'Balikobot-Test_obchod.cz',
                'contact_person' => 'DPD_2',
                'street'         => 'Kovářská 12',
                'city'           => 'Praha 9',
                'zip'            => '19000',
                'country'        => 'CZ',
                'email'          => 'info@balikobot.cz',
                'url'            => 'http://www.balikobot_test2.cz',
                'phone'          => '+420123456789',
            ],
            'live_account' => false,
            'carriers'     => [
                [
                    'name' => 'Česká pošta',
                    'slug' => 'cp',
                ],
                [
                    'name' => 'PPL',
                    'slug' => 'ppl',
                ],
                [
                    'name' => 'DPD',
                    'slug' => 'dpd',
                ],
            ],
        ]);

        $client = new Client($requester);

        $client->getAccountInfo();

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/info/whoami', []]
        );

        self::assertTrue(true);
    }
}
