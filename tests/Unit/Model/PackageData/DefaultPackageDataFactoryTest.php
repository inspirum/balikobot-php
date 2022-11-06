<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\PackageData;

use Inspirum\Balikobot\Model\PackageData\DefaultPackageData;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageDataFactory;
use Inspirum\Balikobot\Model\PackageData\PackageData;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use Throwable;

final class DefaultPackageDataFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreate
     */
    public function testCreate(array $data, PackageData|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultPackageDataFactory();

        $model = $factory->create($data);

        self::assertEquals($result, $model);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreate(): iterable
    {
        yield 'valid' => [
            'data'   => [],
            'result' => new DefaultPackageData(
                [],
            ),
        ];
    }

    private function newDefaultPackageDataFactory(): DefaultPackageDataFactory
    {
        return new DefaultPackageDataFactory();
    }
}
