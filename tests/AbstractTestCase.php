<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests;

use GuzzleHttp\Psr7\Response;
use Inspirum\Balikobot\Services\Requester;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use function is_array;
use function json_encode;

abstract class AbstractTestCase extends PHPUnitTestCase
{
    /**
     * Set up the test environment, before each test.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Get partial mocked API requester instance with overridden call method.
     *
     * @param int                 $statusCode
     * @param array<mixed>|string $data
     * @param array<mixed>|null   $with
     *
     * @return \Inspirum\Balikobot\Services\Requester&\PHPUnit\Framework\MockObject\MockObject
     */
    protected function newRequesterWithMockedRequestMethod(int $statusCode, array|string $data, ?array $with = null)
    {
        $requester = $this->getMockBuilder(Requester::class)
                          ->setConstructorArgs(['test', 'test'])
                          ->disableOriginalClone()
                          ->disableArgumentCloning()
                          ->disallowMockingUnknownTypes()
                          ->onlyMethods(['request'])
                          ->getMock();

        if (is_array($data)) {
            $data = json_encode($data);
        }

        $invocation = $requester->expects(self::atMost(1))->method('request');
        if ($with !== null) {
            $invocation = $invocation->with(...$with);
        }

        $invocation->willReturn(new Response($statusCode, [], (string) $data));

        return $requester;
    }
}
