<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\Changelog;

use DateTimeImmutable;
use Inspirum\Balikobot\Model\Changelog\ChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelog;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogCollection;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogFactory;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogStatus;
use Inspirum\Balikobot\Model\Changelog\DefaultChangelogStatusCollection;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Throwable;

final class DefaultChangelogFactoryTest extends BaseTestCase
{
    /**
     * @param array<string,mixed> $data
     */
    #[DataProvider('providesTestCreateCollection')]
    public function testCreateCollection(array $data, ChangelogCollection|Throwable $result): void
    {
        if ($result instanceof Throwable) {
            $this->expectException($result::class);
            $this->expectExceptionMessage($result->getMessage());
        }

        $factory = $this->newDefaultChangelogFactory();

        $collection = $factory->createCollection($data);

        self::assertEquals($result, $collection);
    }

    /**
     * @return iterable<array<string,mixed>>
     */
    public static function providesTestCreateCollection(): iterable
    {
        yield 'valid' => [
            'data'    => [
                'status'                  => 200,
                'status_message'          => 'Operace proběhla v pořádku.',
                'api_v1_documentation_cz' => 'https://balikobot.docs.apiary.io/',
                'api_v2_documentation_cz' => 'https://balikobotv2.docs.apiary.io/',
                'api_v1_documentation_en' => 'https://balikoboteng.docs.apiary.io/',
                'api_v2_documentation_en' => 'https://balikobotv2eng.docs.apiary.io/',
                'version'                 => '1.900',
                'date'                    => '2020-12-18',
                'versions'                => [
                    0 => [
                        'version' => '1.900',
                        'date'    => '2020-12-18',
                        'changes' => [
                            0 => [
                                'name'        => 'ADD Zásilkovna',
                                'description' => '- delivery_costs a delivery_costs_eur - přidání GB',
                            ],
                            1 => [
                                'name'        => 'ADD PbH',
                                'description' => '- content data - přidání GB',
                            ],
                        ],
                    ],
                    1 => [
                        'version' => '1.899',
                        'date'    => '2020-12-07',
                        'changes' => [
                            0 => [
                                'name'        => 'ADD Gebrüder Weiss Česká republika',
                                'description' => '- nový atribut rec_floor_number - číslo patra',
                            ],
                        ],
                    ],
                ],
            ],
            'result'     => new DefaultChangelogCollection([
                new DefaultChangelog(
                    '1.900',
                    new DateTimeImmutable('2020-12-18'),
                    new DefaultChangelogStatusCollection([
                        new DefaultChangelogStatus(
                            'ADD Zásilkovna',
                            '- delivery_costs a delivery_costs_eur - přidání GB',
                        ),
                        new DefaultChangelogStatus(
                            'ADD PbH',
                            '- content data - přidání GB',
                        ),
                    ]),
                ),
                new DefaultChangelog(
                    '1.899',
                    new DateTimeImmutable('2020-12-07'),
                    new DefaultChangelogStatusCollection([
                        new DefaultChangelogStatus(
                            'ADD Gebrüder Weiss Česká republika',
                            '- nový atribut rec_floor_number - číslo patra',
                        ),
                    ]),
                ),
            ]),
        ];
    }

    private function newDefaultChangelogFactory(): DefaultChangelogFactory
    {
        return new DefaultChangelogFactory();
    }
}
