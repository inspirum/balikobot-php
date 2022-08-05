<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use Inspirum\Balikobot\Definitions\AttributeType;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Request;
use Inspirum\Balikobot\Definitions\VersionType;
use Inspirum\Balikobot\Model\Attribute\Attribute;
use Inspirum\Balikobot\Model\Method\Method;
use ReflectionClass;
use function array_diff;
use function array_map;
use function array_merge;
use function array_unique;
use function array_values;
use function sprintf;

class ChangesSupportTest extends BaseTestCase
{
    public function testLatestChangesSupport(): void
    {
        $infoService = $this->newDefaultInfoService();

        $changelog = $infoService->getChangelog();

        $expected = '1.955';
        $actual   = $changelog->getLatestVersion();

        if ($actual > $expected) {
            $this->addWarning(sprintf('Package not supporting latest changes [%s > %s]', $actual, $expected));
        } else {
            self::assertSame($expected, $actual);
        }
    }

    public function testAllAddAttributesSupport(): void
    {
        $settingService = $this->newDefaultSettingService();
        $attributes     = [];

        foreach (Carrier::all() as $carrier) {
            $attributes[] = array_map(
                static fn(Attribute $attribute): string => $attribute->getName(),
                $settingService->getAddAttributes($carrier)->getAttributes(),
            );
        }

        $attributes = array_unique(array_merge(...$attributes));

        $options             = new ReflectionClass(AttributeType::class);
        $supportedAttributes = array_values($options->getConstants());

        $unsupportedAttributes = array_diff($attributes, $supportedAttributes);

        foreach ($unsupportedAttributes as $unsupportedAttribute) {
            self::addWarning(sprintf('Unsupported ADD attribute "%s"', $unsupportedAttribute));
        }
    }

    public function testAllMethodsSupport(): void
    {
        $infoService = $this->newDefaultInfoService();
        $methods     = [];

        foreach (Carrier::all() as $carrier) {
            $methods[] = array_map(
                static fn(Method $method): string => $method->getCode(),
                $infoService->getCarrier($carrier)->getMethodsForVersion(VersionType::V2V1)->getMethods(),
            );
        }

        $methods = array_map('strtolower', array_unique(array_merge(...$methods)));

        $options          = new ReflectionClass(Request::class);
        $supportedMethods = array_map('strtolower', array_values($options->getConstants()));

        $unsupportedMethods = array_diff($methods, $supportedMethods);

        foreach ($unsupportedMethods as $unsupportedMethod) {
            self::addWarning(sprintf('Unsupported method "%s"', $unsupportedMethod));
        }
    }
}
