<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Label;

use Inspirum\Balikobot\Model\Label\DefaultLabelFactory;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use Throwable;

final class DefaultLabelFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreate
     */
    public function testCreate(array $data, string|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultLabelFactory();

        $item = $factory->create($data);

        self::assertEquals($result, $item);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreate(): iterable
    {
        yield 'valid' => [
            'data'    => [
                'labels_url' => 'http://pdf.balikobot.cz/dpd/eNorMdY1NFwwXDAELgE2',
            ],
            'result'  =>  'http://pdf.balikobot.cz/dpd/eNorMdY1NFwwXDAELgE2',
        ];
    }

    private function newDefaultLabelFactory(): DefaultLabelFactory
    {
        return new DefaultLabelFactory();
    }
}
