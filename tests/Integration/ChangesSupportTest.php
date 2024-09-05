<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Integration;

use Inspirum\Balikobot\Definitions\Attribute;
use Inspirum\Balikobot\Definitions\Carrier;
use Inspirum\Balikobot\Definitions\Method;
use Inspirum\Balikobot\Definitions\Version;
use Inspirum\Balikobot\Exception\Exception;
use Inspirum\Balikobot\Model\Attribute\Attribute as AttributeModel;
use Inspirum\Balikobot\Model\Method\Method as MethodModel;
use function array_diff;
use function array_map;
use function array_merge;
use function array_unique;
use function sprintf;
use function str_replace;
use function strtolower;

final class ChangesSupportTest extends BaseTestCase
{
    public function testLatestChangesSupport(): void
    {
        $infoService = $this->newDefaultInfoService();

        $changelog = $infoService->getChangelog();

        $expected = (float) '2.004';
        $actual = (float) $changelog->getLatestVersion();

        if ($actual > $expected) {
            self::markTestIncomplete(sprintf('Package not supporting latest changes [%.3f > %.3f]', $actual, $expected));
        } else {
            self::assertLessThanOrEqual($expected, $actual);
        }
    }

    public function testAllAddAttributesSupport(): void
    {
        $settingService = $this->newDefaultSettingService();
        $attributes = [];

        foreach (Carrier::getAll() as $carrier) {
            try {
                $attributes[] = array_map(
                    static fn (AttributeModel $attribute): string => $attribute->getName(),
                    $settingService->getAddAttributes($carrier)->getAttributes(),
                );
            } catch (Exception $exception) {
                if ($exception->getStatusCode() === 503) {
                    continue;
                }

                throw $exception;
            }
        }

        $attributes = array_unique(array_merge(...$attributes));
        $supportedAttributes = Attribute::getAll();

        $unsupportedAttributes = array_diff($attributes, $supportedAttributes);

        foreach ($unsupportedAttributes as $unsupportedAttribute) {
            self::markTestIncomplete(sprintf('Unsupported ADD attribute "%s"', $unsupportedAttribute));
        }

        $this->assertNoException();
    }

    public function testAllMethodsSupport(): void
    {
        $settingService = $this->newDefaultSettingService();
        $methods = [];

        foreach (Carrier::getAll() as $carrier) {
            $methods[] = array_map(
                static fn (MethodModel $method): string => str_replace(' ', '/', strtolower($method->getCode())),
                $settingService->getCarrier($carrier)->getMethodsForVersion(Version::V2V1)->getMethods(),
            );
        }

        $methods = array_unique(array_merge(...$methods));
        $supportedMethods = array_map(strtolower(...), Method::getAll());

        $unsupportedMethods = array_diff($methods, $supportedMethods);

        foreach ($unsupportedMethods as $unsupportedMethod) {
            self::markTestIncomplete(sprintf('Unsupported method "%s"', $unsupportedMethod));
        }

        $this->assertNoException();
    }
}
