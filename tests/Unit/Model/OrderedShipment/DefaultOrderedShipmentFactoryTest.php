<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\OrderedShipment;

use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Model\OrderedShipment\DefaultOrderedShipment;
use Inspirum\Balikobot\Model\OrderedShipment\DefaultOrderedShipmentFactory;
use Inspirum\Balikobot\Model\OrderedShipment\OrderedShipment;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use Throwable;

final class DefaultOrderedShipmentFactoryTest extends BaseTestCase
{
    /**
     * @param array<string>       $packageIds
     * @param array<string,mixed> $data
     *
     * @dataProvider providesTestCreateCollection
     */
    public function testCreateCollection(string $carrier, array $packageIds, array $data, OrderedShipment|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultOrderedShipmentFactory();

        $item = $factory->create($carrier, $packageIds, $data);

        self::assertEquals($result, $item);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'carrier' => Carrier::CP,
            'packageIds' =>   ['1', '67'],
            'data'    => [
                'labels_url'   => 'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                'order_id'     => '1234',
                'file_url'     => 'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
                'handover_url' => 'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
                'package_ids'  => ['1', '67'],
            ],
            'result'  =>  new DefaultOrderedShipment(
                '1234',
                'cp',
                ['1', '67'],
                'http://pdf.balikobot.cz/cp/eNoz0jW0BfwwAe5cMMo.',
                'https://pdf.balikobot.cz/cp/eNorMTIwt9A1NbYwMwdcMBAZAoA.',
                'http://csv.balikobot.cz/cp/eNoz0jUFXDABKFwwlQ..',
            ),
        ];
    }

    private function newDefaultOrderedShipmentFactory(): DefaultOrderedShipmentFactory
    {
        return new DefaultOrderedShipmentFactory();
    }
}
