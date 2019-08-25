<?php

namespace Inspirum\Balikobot\Services;

use GuzzleHttp\Psr7\Response;
use Inspirum\Balikobot\Contracts\RequesterInterface;
use Inspirum\Balikobot\Exceptions\BadRequestException;
use Inspirum\Balikobot\Exceptions\UnauthorizedException;
use Psr\Http\Message\ResponseInterface;

class Requester implements RequesterInterface
{
    /**
     * API URL
     *
     * @var string[]
     */
    private const API_URL = [
        'v1' => 'https://api.balikobot.cz/',
        'v2' => 'https://api.balikobot.cz/v2/',
    ];

    /**
     * API User
     *
     * @var string
     */
    private $apiUser;

    /**
     * API key
     *
     * @var string
     */
    private $apiKey;

    /**
     * Balikobot API client
     *
     * @param string $apiUser
     * @param string $apiKey
     */
    public function __construct(string $apiUser, string $apiKey)
    {
        $this->apiUser = $apiUser;
        $this->apiKey  = $apiKey;
    }

    /**
     * Call API
     *
     * @param string $version
     * @param string $request
     * @param string $shipper
     * @param array  $data
     * @param bool   $shouldHaveStatus
     *
     * @return array
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function call(
        string $version,
        string $shipper,
        string $request,
        array $data = [],
        bool $shouldHaveStatus = true
    ): array {
        // resolve url
        $path = trim($shipper . '/' . $request, '/');
        $host = $this->resolveHostName($version);

        // call API server and get response
        $response = $this->request($host . $path, $data);

        // get status code and content
        $statusCode = $response->getStatusCode();
        $content    = $response->getBody()->getContents();

        // parse response content to assoc array
        $content = json_decode($content, true);

        // return empty array when json_decode fails
        if ($content === null) {
            $content = [];
        }

        // validate response status code
        $this->validateResponse($statusCode, $content, $shouldHaveStatus);

        // return response
        return $content;
    }

    /**
     * Get API response
     *
     * @param string $url
     * @param array  $data
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request(string $url, array $data = []): ResponseInterface
    {
        // init curl
        $ch = curl_init();

        // set headers
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        // set data
        if (count($data) > 0) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        // set auth
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode($this->apiUser . ':' . $this->apiKey),
            'Content-Type: application/json',
        ]);

        // execute curl
        $response   = (string) curl_exec($ch);
        $statusCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // close curl
        curl_close($ch);

        return new Response($statusCode, [], $response);
    }

    /**
     * Get API url for given version
     *
     * @param string $version
     *
     * @return string
     */
    private function resolveHostName(string $version): string
    {
        return isset(self::API_URL[$version]) ? self::API_URL[$version] : self::API_URL['v1'];
    }

    /**
     * Validate response
     *
     * @param int   $statusCode
     * @param array $response
     * @param bool  $shouldHaveStatus
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    private function validateResponse(int $statusCode, array $response, bool $shouldHaveStatus): void
    {
        $this->validateStatus($statusCode, $response);

        $this->validateResponseStatus($response, $shouldHaveStatus);
    }

    /**
     * Validate status code
     *
     * @param int   $statusCode
     * @param array $response
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    private function validateStatus(int $statusCode, array $response = []): void
    {
        // unauthorize
        if ($statusCode === 401) {
            throw new UnauthorizedException();
        }

        // request error
        if ($statusCode !== 200) {
            throw new BadRequestException($response, $statusCode);
        }
    }

    /**
     * Validate response status
     *
     * @param array $response
     * @param bool  $shouldHaveStatus
     *
     * @return void
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    private function validateResponseStatus(array $response, bool $shouldHaveStatus): void
    {
        // no status to validate
        if (isset($response['status']) === false && $shouldHaveStatus === false) {
            return;
        }

        $statusCode = (int) ($response['status'] ?? 500);

        if ($statusCode !== 200) {
            throw new BadRequestException($response, $statusCode);
        }
    }
}
