<?php

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Exceptions\UnauthorizedException;

class ExceptionsTest extends AbstractClientTestCase
{
    public function testThrowsExceptionOnError()
    {
        $this->expectException(UnauthorizedException::class);

        $client = $this->newMockedClient(401, []);

        $client->addPackages('cp', []);
    }

    public function testThrowsExceptionMatchStatusCode()
    {
        $client = $this->newMockedClient(409, []);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(409, $exception->getStatusCode());
        }
    }

    public function testThrowsExceptionMatchStatusCodeFromResponse()
    {
        $client = $this->newMockedClient(200, [
            'status' => 419,
        ]);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(419, $exception->getStatusCode());
        }
    }

    public function testThrowsExceptionMatchResponse()
    {
        $client = $this->newMockedClient(409, [
            'test'   => 1,
            'errors' => [
                'id' => 404,
            ],
        ]);

        try {
            $client->addPackages('cp', []);
        } catch (ExceptionInterface $exception) {
            $this->assertEquals(['test' => 1, 'errors' => ['id' => 404]], $exception->getResponse());
            $this->assertEquals('{"test":1,"errors":{"id":404}}', $exception->getResponseAsString());
        }
    }

    public function testThrowsExceptionMatchSimpleErrors()
    {
        $client = $this->newMockedClient(200, [
            'status'   => 400,
            'packages' => [
                0 => [
                    'status'   => 413,
                    'id'       => 404,
                    'eid'      => 'Missing',
                    'rec_name' => 406,
                ],
                1 => [
                    'aa' => 406,
                ],
            ],
        ]);

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

    public function testThrowsExceptionMatchSimpleErrorsWithOlderResponse()
    {
        $client = $this->newMockedClient(200, [
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

    public function testThrowsExceptionMatchSimpleErrorsWithStatusCode()
    {
        $client = $this->newMockedClient(200, [
            'status'   => 400,
            'packages' => [
                0 => 406,
                1 => [
                    'eid' => 413,
                ],
            ],
        ]);

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
        $client = $this->newMockedClient(200, [
            'status'   => 400,
            'packages' => [
                0 => [
                    'eid' => 413,
                ],
                1 => 'test',
            ],
        ]);

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
        $client = $this->newMockedClient(200, [
            'status'   => 400,
            'packages' => [
                0 => [
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
                1 => [
                    'errors' => [
                        [
                            'type'      => '406',
                            'attribute' => 'service_type',
                            'message'   => 'Nedorazilo ID vybrané služby přepravce.',
                        ],
                    ],
                ],
            ],
        ]);

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
