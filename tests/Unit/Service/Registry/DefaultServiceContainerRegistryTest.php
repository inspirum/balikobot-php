<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Service\Registry;

use Inspirum\Balikobot\Exception\ServiceContainerNotFoundException;
use Inspirum\Balikobot\Service\Registry\DefaultServiceContainerRegistry;
use Inspirum\Balikobot\Service\Registry\ServiceContainer;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

final class DefaultServiceContainerRegistryTest extends BaseTestCase
{
    public function testRegistry(): void
    {
        $items = [
            'default' => $this->createMock(ServiceContainer::class),
            'test1' => $this->createMock(ServiceContainer::class),
            'test2' => $this->createMock(ServiceContainer::class),
        ];

        $registry = new DefaultServiceContainerRegistry($items);

        self::assertSame($items['default'], $registry->get());
        self::assertSame($items['test2'], $registry->get('test2'));
    }

    public function testRegistryInvalidKey(): void
    {
        $this->expectException(ServiceContainerNotFoundException::class);
        $this->expectExceptionMessageMatches('/Service container for "test3" connection is not available/');

        $items = [
            'default' => $this->createMock(ServiceContainer::class),
            'test1' => $this->createMock(ServiceContainer::class),
            'test2' => $this->createMock(ServiceContainer::class),
        ];

        $registry = new DefaultServiceContainerRegistry($items);

        $registry->get('test3');
    }

    public function testRegistryMissingDefault(): void
    {
        $this->expectException(ServiceContainerNotFoundException::class);
        $this->expectExceptionMessageMatches('/Service container for "default" connection is not available/');

        $items = [
            'test1' => $this->createMock(ServiceContainer::class),
            'test2' => $this->createMock(ServiceContainer::class),
        ];

        $registry = new DefaultServiceContainerRegistry($items);

        self::assertSame($items['test2'], $registry->get('test2'));

        $registry->get();
    }

    public function testRegistryCustomDefaultKey(): void
    {
        $items = [
            'base' => $this->createMock(ServiceContainer::class),
            'test2' => $this->createMock(ServiceContainer::class),
        ];

        $registry = new DefaultServiceContainerRegistry($items, 'base');

        self::assertSame($items['base'], $registry->get());
        self::assertSame($items['test2'], $registry->get('test2'));
    }

    public function testRegistryAdd(): void
    {
        $items = [];

        $registry = new DefaultServiceContainerRegistry($items);

        $item = $this->createMock(ServiceContainer::class);
        $registry->add('test3', $item);

        self::assertSame($item, $registry->get('test3'));
    }
}
