<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Balikobot;

use Generator;
use Inspirum\Balikobot\Model\Values\PostCode;
use Inspirum\Balikobot\Services\Balikobot;

class GetPostCodesMethodTest extends AbstractBalikobotTestCase
{
    public function testMakeRequest(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'    => 200,
            'zip_codes' => [],
        ]);

        $service = new Balikobot($requester);

        $postCodes = $service->getPostCodes('ppl', '7');

        $postCodes->valid();

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/zipcodes/7',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testMakeRequestWithCountry(): void
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status'    => 200,
            'zip_codes' => [],
        ]);

        $service = new Balikobot($requester);

        $postCodes = $service->getPostCodes('ppl', '7', 'CZ');

        $postCodes->valid();

        $requester->shouldHaveReceived(
            'request',
            [
                'https://apiv2.balikobot.cz/ppl/zipcodes/7/CZ',
                [],
            ]
        );

        $this->assertTrue(true);
    }

    public function testResponseData(): void
    {
        $service = $this->newMockedBalikobot(200, [
            'status'       => 200,
            'service_type' => 'NP',
            'type'         => 'zip',
            'zip_codes'    => [
                [
                    'zip'     => '35002',
                    '1B'      => false,
                    'country' => 'CZ',
                ],
                [
                    'zip'     => '19000',
                    '1B'      => true,
                    'country' => 'CZ',
                ],
            ],
        ]);

        $postCodes = $service->getPostCodes('cp', 'NP');

        $this->assertInstanceOf(Generator::class, $postCodes);

        /** @var \Inspirum\Balikobot\Model\Values\PostCode $postCode */
        $postCode = $postCodes->current();

        $this->assertInstanceOf(PostCode::class, $postCode);
        $this->assertEquals('35002', $postCode->getPostcode());

        $postCodes->next();
        $postCode = $postCodes->current();

        $this->assertInstanceOf(PostCode::class, $postCode);
        $this->assertEquals('19000', $postCode->getPostcode());

        $postCodes->next();
        $postCode = $postCodes->current();

        $this->assertEquals(null, $postCode);
    }
}
