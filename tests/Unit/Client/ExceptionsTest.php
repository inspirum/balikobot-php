<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Exceptions\UnauthorizedException;
use Inspirum\Balikobot\Services\Client;

class ExceptionsTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(UnauthorizedException::class);

        $requester = $this->newRequesterWithMockedRequestMethod(401, []);

        $client = new Client($requester);

        $client->addPackages('cp', []);
    }

    public function testThrowsExceptionMatchStatusCode()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(409, []);

        $client = new Client($requester);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(409, $exception->getStatusCode());
        }
    }

    public function testThrowsExceptionMatchStatusCodeFromResponse()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, ['status' => 419]);

        $client = new Client($requester);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(419, $exception->getStatusCode());
        }
    }

    public function testThrowsExceptionMatchResponse()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(409, [
            'test'   => 1,
            'errors' => [
                'id' => 404,
            ],
        ]);

        $client = new Client($requester);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(['test' => 1, 'errors' => ['id' => 404]], $exception->getResponse());
            $this->assertEquals('{"test":1,"errors":{"id":404}}', $exception->getResponseAsString());
        }
    }

    public function testThrowsExceptionMatchSimpleErrors()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
            0        => [
                'status'   => 413,
                'id'       => 404,
                'eid'      => 'Missing',
                'rec_name' => 406,
            ],
            1        => [
                'aa' => 406,
            ],
        ]);

        $client = new Client($requester);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(
                [
                    0 => [
                        'status'   => 'Špatný formát dat.',
                        'id'       => 'Nespecifikovaná chyba.',
                        'rec_name' => 'Nedorazilo jméno příjemce.',
                    ],
                    1 => [
                        'aa' => 'Nedorazila žádná data ke zpracování.',
                    ],
                ],
                $exception->getErrors()
            );
        }
    }

    public function testThrowsExceptionMatchMessageWithErrors()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
            0        => [
                'status'   => 413,
                'id'       => 404,
                'eid'      => 'Missing',
                'rec_name' => 406,
            ],
            1        => [
                'aa' => 406,
            ],
        ]);

        $client = new Client($requester);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(
                'Operace neproběhla v pořádku, zkontrolujte konkrétní data.' . "\n" .
                '[0][status]: Špatný formát dat.' . "\n" .
                '[0][id]: Nespecifikovaná chyba.' . "\n" .
                '[0][rec_name]: Nedorazilo jméno příjemce.' . "\n" .
                '[1][aa]: Nedorazila žádná data ke zpracování.',
                $exception->getMessage()
            );
        }
    }

    public function testThrowsExceptionMatchSimpleErrorsWithStatusCode()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
            0        => 406,
            1        => [
                'eid' => 413,
            ],
        ]);

        $client = new Client($requester);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(
                [
                    0 => [
                        'status' => 'Nedorazila žádná data ke zpracování nebo nemůžou být akceptována.',
                    ],
                    1 => [
                        'eid' => 'Eshop ID je delší než je maximální povolená délka.',
                    ],
                ],
                $exception->getErrors()
            );
        }
    }

    public function testThrowsExceptionMatchSimpleErrorsWithUnexpectedValue()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
            0        => [
                'eid' => 413,
            ],
            1        => 'test',
        ]);

        $client = new Client($requester);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(
                [
                    0 => [
                        'eid' => 'Eshop ID je delší než je maximální povolená délka.',
                    ],
                    1 => [
                        'status' => 'Nespecifikovaná chyba.',
                    ],
                ],
                $exception->getErrors()
            );
        }
    }

    public function testThrowsExceptionMatchErrors()
    {
        $requester = $this->newRequesterWithMockedRequestMethod(200, [
            'status' => 400,
            0        => [
                'errors' => [
                    [
                        'type'      => '413',
                        'attribute' => 'rec_zip',
                        'message'   => 'Nepovolené PSČ příjemce.',
                    ],
                    [
                        'type'      => '406',
                        'attribute' => 'eid',
                        'message'   => 'Nedorazilo eshop ID.',
                    ],
                ],
            ],
            1        => [
                'errors' => [
                    [
                        'type'      => '406',
                        'attribute' => 'service_type',
                        'message'   => 'Nedorazilo ID vybrané služby přepravce.',
                    ],
                ],
            ],
        ]);

        $client = new Client($requester);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(
                [
                    0 => [
                        'rec_zip' => 'Nepovolené PSČ příjemce.',
                        'eid'     => 'Nedorazilo eshop ID.',
                    ],
                    1 => [
                        'service_type' => 'Nedorazilo ID vybrané služby přepravce.',
                    ],
                ],
                $exception->getErrors()
            );
        }
    }
}
