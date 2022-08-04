<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\ProofOfDelivery;

use Inspirum\Balikobot\Client\Response\Validator;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Model\ProofOfDelivery\DefaultProofOfDeliveryFactory;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use Throwable;

final class DefaultProofOfDeliveryFactoryTest extends BaseTestCase
{
    /**
     * @param array<string>            $carrierIds
     * @param array<string,mixed>      $data
     * @param array<string>|\Throwable $result
     *
     * @dataProvider providesTestCreate
     */
    public function testCreate(array $carrierIds, array $data, array|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultProofOfDeliveryFactory();

        $item = $factory->create($carrierIds, $data);

        self::assertEquals($result, $item);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreate(): iterable
    {
        yield 'valid' => [
            'carrierIds' => [
                '123',
                '456',
                '789',
            ],
            'data'    => [
                0 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
                ],
                1 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/rNorMTY11DUEXDAFrwFs',
                ],
                2 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/tNorMTY11DUEXDAFrwFs',
                ],
            ],
            'result'  =>  [
                'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
                'https://pod.balikobot.cz/tnt/rNorMTY11DUEXDAFrwFs',
                'https://pod.balikobot.cz/tnt/tNorMTY11DUEXDAFrwFs',
            ],
        ];

        yield 'invalid_status' => [
            'carrierIds' => [
                '123',
                '456',
                '789',
            ],
            'data'    => [
                0 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
                ],
                1 => [
                    'status'   => 404,
                ],
                2 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/tNorMTY11DUEXDAFrwFs',
                ],
            ],
            'result'  =>  new BadRequestException([], 404),
        ];

        yield 'missing_status' => [
            'carrierIds' => [
                '123',
                '456',
                '789',
            ],
            'data'    => [
                0 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
                ],
                1 => [
                    'file_url' => 'https://pod.balikobot.cz/tnt/rNorMTY11DUEXDAFrwFs',
                ],
                2 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/tNorMTY11DUEXDAFrwFs',
                ],
            ],
            'result'  =>  new BadRequestException([], 500),
        ];

        yield 'invalid_index' => [
            'carrierIds' => [
                '123',
                '456',
                '789',
            ],
            'data'    => [
                0 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
                ],
                2 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/rNorMTY11DUEXDAFrwFs',
                ],
                3 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/tNorMTY11DUEXDAFrwFs',
                ],
            ],
            'result'  =>  new BadRequestException([], 400),
        ];

        yield 'invalid_response_count' => [
            'carrierIds' => [
                '123',
                '456',
                '789',
            ],
            'data'    => [
                0 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
                ],
                1 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/rNorMTY11DUEXDAFrwFs',
                ],
            ],
            'result'  =>  new BadRequestException([], 400),
        ];

        yield 'invalid_input_count' => [
            'carrierIds' => [
                '123',
            ],
            'data'    => [
                0 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/eNorMTY11DUEXDAFrwFs',
                ],
                1 => [
                    'status'   => 200,
                    'file_url' => 'https://pod.balikobot.cz/tnt/rNorMTY11DUEXDAFrwFs',
                ],
            ],
            'result'  =>  new BadRequestException([], 400),
        ];
    }

    private function newDefaultProofOfDeliveryFactory(): DefaultProofOfDeliveryFactory
    {
        return new DefaultProofOfDeliveryFactory(new Validator());
    }
}
