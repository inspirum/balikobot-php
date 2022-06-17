<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Client;

use Inspirum\Balikobot\Client\DefaultClient;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Exception\Exception;
use Inspirum\Balikobot\Exception\UnauthorizedException;
use Inspirum\Balikobot\Response\Validator;
use Inspirum\Balikobot\Tests\BaseTestCase;
use Throwable;
use function gzcompress;
use function is_array;
use function json_encode;

final class DefaultClientTest extends BaseTestCase
{
    /**
     * @param array<mixed, mixed>|string          $response
     * @param \Throwable|array<mixed, mixed>|bool $result
     *
     * @dataProvider providesTestCall()
     */
    public function testCall(
        int $statusCode,
        array|string $response,
        bool $shouldHaveStatus,
        Throwable|array|bool $result,
        bool $gzip = false,
    ): void {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $client = $this->newDefaultClient($statusCode, $response);

        $actualResponse = $client->call(Version::V1V1, Carrier::CP, Request::ADD, shouldHaveStatus: $shouldHaveStatus, gzip: $gzip);

        if ($result === true) {
            self::assertSame($response, $actualResponse);
        } elseif (is_array($result)) {
            self::assertSame($result, $actualResponse);
        }
    }

    /**
     * @return iterable<array<mixed, mixed>>
     */
    public function providesTestCall(): iterable
    {
        yield 'status_error' => [
            'statusCode'       => 400,
            'response'         => [
                'status' => 200,
                'test'   => 1596,
            ],
            'shouldHaveStatus' => true,
            'result'           => new BadRequestException([], 400),
        ];

        yield 'response_status_error' => [
            'statusCode'       => 200,
            'response'         => [
                'status' => 400,
                'test'   => 1596,
            ],
            'shouldHaveStatus' => true,
            'result'           => new BadRequestException([], 400),
        ];

        yield 'should_have_status' => [
            'statusCode'       => 200,
            'response'         => [
                'test' => 1596,
            ],
            'shouldHaveStatus' => true,
            'result'           => new BadRequestException([], 500),
        ];

        yield 'should_not_have_status' => [
            'statusCode'       => 200,
            'response'         => [
                'test' => 1596,
            ],
            'shouldHaveStatus' => false,
            'result'           => true,
        ];

        yield 'uncompressed' => [
            'statusCode'       => 200,
            'response'         => [
                'status' => 200,
                'test'   => 1596,
            ],
            'shouldHaveStatus' => true,
            'result'           => true,
            'gzip'             => false,
        ];

        yield 'compressed' => [
            'statusCode'       => 200,
            'response'         => (string) gzcompress((string) json_encode([
                'status' => 200,
                'test'   => 1596,
            ])),
            'shouldHaveStatus' => true,
            'result'           => [
                'status' => 200,
                'test'   => 1596,
            ],
            'gzip'             => true,
        ];

        yield 'compressed_error' => [
            'statusCode'       => 200,
            'response'         => (string) gzcompress((string) json_encode([
                'status' => 200,
                'test'   => 1596,
            ])),
            'shouldHaveStatus' => true,
            'result'           => new BadRequestException([], 400, message: 'Cannot parse response data'),
            'gzip'             => false,
        ];

        yield 'compressed_fallback' => [
            'statusCode'       => 200,
            'response'         => [
                'status' => 200,
                'test'   => 1596,
            ],
            'shouldHaveStatus' => true,
            'result'           => true,
            'gzip'             => true,
        ];
    }

    /**
     * @param array<mixed,mixed>          $response
     * @param array<array<string,string>> $errors
     *
     * @dataProvider providerCallException()
     */
    public function testCallExceptions(
        int $statusCode,
        array $response,
        Exception $result,
        array|null $errors = null,
    ): void {
        $client = $this->newDefaultClient($statusCode, $response);

        try {
            $client->call(Version::V1V1, Carrier::CP, Request::ADD);
        } catch (Exception $exception) {
            self::assertInstanceOf($result::class, $exception);
            self::assertSame($result->getStatusCode(), $exception->getStatusCode());
            if ($result->getMessage() !== '') {
                self::assertSame($result->getMessage(), $exception->getMessage());
            }

            self::assertEquals($response, $exception->getResponse());
            self::assertEquals(json_encode($response), $exception->getResponseAsString());
            if ($errors !== null) {
                self::assertEquals($errors, $exception->getErrors());
            }
        }
    }

    /**
     * @return iterable<array<mixed, mixed>>
     */
    public function providerCallException(): iterable
    {
        yield 'status_error_401' => [
            'statusCode' => 401,
            'response'   => [],
            'result'     => new UnauthorizedException(),
        ];

        yield 'status_error_403' => [
            'statusCode' => 403,
            'response'   => [],
            'result'     => new UnauthorizedException(statusCode: 403),
        ];

        yield 'status_code_match' => [
            'statusCode' => 409,
            'response'   => [],
            'result'     => new BadRequestException([], 409),
        ];

        yield 'response_status_code_match' => [
            'statusCode' => 200,
            'response'   => [
                'status' => 419,
            ],
            'result'     => new BadRequestException([], 419),
        ];

        yield 'response_match' => [
            'statusCode' => 409,
            'response'   => [
                'test'   => 1,
                'errors' => [
                    'id' => 404,
                ],
            ],
            'result'     => new BadRequestException([], 409),
        ];

        yield 'simple_errors' => [
            'statusCode' => 200,
            'response'   => [
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
            ],
            'result'     => new BadRequestException([], 400, message: ''),
            'errors'     => [
                0 => [
                    'status'   => 'Špatný formát dat.',
                    'id'       => 'Nespecifikovaná chyba.',
                    'rec_name' => 'Nedorazilo jméno příjemce.',
                ],
                1 => [
                    'aa' => 'Nedorazila žádná data ke zpracování.',
                ],
            ],
        ];

        yield 'simple_errors_older_response' => [
            'statusCode' => 200,
            'response'   => [
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
            ],
            'result'     => new BadRequestException([], 400, message: ''),
            'errors'     => [
                0 => [
                    'status'   => 'Špatný formát dat.',
                    'id'       => 'Nespecifikovaná chyba.',
                    'rec_name' => 'Nedorazilo jméno příjemce.',
                ],
                1 => [
                    'aa' => 'Nedorazila žádná data ke zpracování.',
                ],
            ],
        ];

        yield 'simple_errors_older_response_error_message' => [
            'statusCode' => 200,
            'response'   => [
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
            ],
            'result'     => new BadRequestException(
                [],
                400,
                message: 'Operace neproběhla v pořádku, zkontrolujte konkrétní data.' . "\n" .
                '[0][status]: Špatný formát dat.' . "\n" .
                '[0][id]: Nespecifikovaná chyba.' . "\n" .
                '[0][rec_name]: Nedorazilo jméno příjemce.' . "\n" .
                '[1][aa]: Nedorazila žádná data ke zpracování.',
            ),
        ];

        yield 'simple_errors_status_code' => [
            'statusCode' => 400,
            'response'   => [
                'packages' => [
                    0 => 406,
                    1 => [
                        'eid' => 413,
                    ],
                ],
            ],
            'result'     => new BadRequestException([], 400, message: ''),
            'errors'     => [
                0 => [
                    'status' => 'Nedorazila žádná data ke zpracování nebo nemůžou být akceptována.',
                ],
                1 => [
                    'eid' => 'Eshop ID je delší než je maximální povolená délka.',
                ],
            ],
        ];

        yield 'simple_errors_unexpected_value' => [
            'statusCode' => 200,
            'response'   => [
                'status'   => 400,
                'packages' => [
                    0 => [
                        'eid' => 413,
                    ],
                    1 => 'test',
                ],
            ],
            'result'     => new BadRequestException([], 400, message: ''),
            'errors'     => [
                0 => [
                    'eid' => 'Eshop ID je delší než je maximální povolená délka.',
                ],
                1 => [
                    'status' => 'Nespecifikovaná chyba.',
                ],
            ],
        ];

        yield 'response_errors' => [
            'statusCode' => 200,
            'response'   => [
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
            ],
            'result'     => new BadRequestException([], 400, message: ''),
            'errors'     => [
                0 => [
                    'rec_zip' => 'Nepovolené PSČ příjemce.',
                    'eid'     => 'Nedorazilo eshop ID.',
                ],
                1 => [
                    'service_type' => 'Nedorazilo ID vybrané služby přepravce.',
                ],
            ],
        ];
    }

    /**
     * @param array<mixed>|string $response
     * @param array<mixed>|null   $request
     */
    private function newDefaultClient(int $statusCode, array|string $response, ?array $request = null): DefaultClient
    {
        $requester = $this->newRequester($statusCode, $response, $request);
        $validator = new Validator();

        return new DefaultClient($requester, $validator);
    }
}
