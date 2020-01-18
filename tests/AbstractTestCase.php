<?php

namespace Inspirum\Balikobot\Tests;

use GuzzleHttp\Psr7\Response;
use Inspirum\Balikobot\Services\Requester;
use Mockery;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

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
     * Get partial mocked API requester instance with overrided call method.
     *
     * @param int          $statusCode
     * @param array|string $data
     *
     * @return \Inspirum\Balikobot\Services\Requester|\Mockery\MockInterface
     */
    protected function newRequesterWithMockedRequestMethod(int $statusCode, $data)
    {
        /* @var \Inspirum\Balikobot\Services\Requester|\Mockery\MockInterface $client */
        $requester = Mockery::mock(Requester::class . '[request]', ['test', 'test']);

        if (is_array($data)) {
            $data = json_encode($data);
        }

        $requester->shouldReceive('request')->andReturn(new Response($statusCode, [], (string) $data));

        return $requester;
    }
}
