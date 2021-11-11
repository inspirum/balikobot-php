<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot\Request;

use Inspirum\Balikobot\Services\Balikobot;
use Inspirum\Balikobot\Tests\Unit\Balikobot\AbstractBalikobotTestCase;

class GetAccountInfoMethodTest extends AbstractBalikobotTestCase
{
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

        $service = new Balikobot($requester);

        $service->getAccountInfo();

        $requester->shouldHaveReceived(
            'request',
            ['https://apiv2.balikobot.cz/info/whoami', []]
        );

        self::assertTrue(true);
    }
}
