<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests;

use GuzzleHttp\Psr7\Response;
use Inspirum\Balikobot\Services\Requester;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use function is_array;
use function json_encode;

abstract class AbstractTestCase extends PHPUnitTestCase
{
    /**
     * Setup the test environment, before each test.
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

        Mockery::close();
    }

    /**
     * Get partial mocked API requester instance with overridden call method.
     *
     * @param int                 $statusCode
     * @param array<mixed>|string $data
     *
     * @return \Inspirum\Balikobot\Services\Requester|\Mockery\MockInterface
     */
    protected function newRequesterWithMockedRequestMethod(int $statusCode, $data): MockInterface
    {
        /** @var \Inspirum\Balikobot\Services\Requester|\Mockery\MockInterface $requester */
        $requester = Mockery::mock(Requester::class . '[request]', ['test', 'test']);

        if (is_array($data)) {
            $data = json_encode($data);
        }

        $requester->shouldReceive('request')->andReturn(new Response($statusCode, [], (string) $data));

        return $requester;
    }
}
