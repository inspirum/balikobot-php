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
