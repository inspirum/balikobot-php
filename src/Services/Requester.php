<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Services;

use GuzzleHttp\Psr7\InflateStream;
use GuzzleHttp\Psr7\Response;
use Inspirum\Balikobot\Contracts\RequesterInterface;
use Inspirum\Balikobot\Definitions\API;
use Inspirum\Balikobot\Exceptions\BadRequestException;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;
use Throwable;
use function base64_encode;
use function count;
use function curl_close;
use function curl_errno;
use function curl_error;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function json_decode;
use function json_encode;
use function str_replace;
use function trim;
use const CURLINFO_HTTP_CODE;
use const CURLOPT_HEADER;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_POST;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_SSL_VERIFYHOST;
use const CURLOPT_SSL_VERIFYPEER;
use const CURLOPT_URL;
use const JSON_THROW_ON_ERROR;

class Requester implements RequesterInterface
{
    /**
     * API User
     *
     * @var string
     */
    private string $apiUser;

    /**
     * API key
     *
     * @var string
     */
    private string $apiKey;

    /**
     * SSL verification enabled
     *
     * @var bool
     */
    private bool $sslVerify;

    /**
     * Response validator
     *
     * @var \Inspirum\Balikobot\Services\Validator
     */
    private Validator $validator;

    /**
     * Balikobot API client
     *
     * @param string $apiUser
     * @param string $apiKey
     * @param bool   $sslVerify
     */
    public function __construct(string $apiUser, string $apiKey, bool $sslVerify = true)
    {
        $this->apiUser   = $apiUser;
        $this->apiKey    = $apiKey;
        $this->sslVerify = $sslVerify;

        $this->validator = new Validator();
    }

    /**
     * Call API
     *
     * @param string             $version
     * @param string             $request
     * @param string             $shipper
     * @param array<mixed,mixed> $data
     * @param bool               $shouldHaveStatus
     * @param bool               $gzip
     *
     * @return array<mixed,mixed>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    public function call(
        string $version,
        string $shipper,
        string $request,
        array $data = [],
        bool $shouldHaveStatus = true,
        bool $gzip = false,
    ): array {
        // resolve url
        $path = trim($shipper . '/' . $request, '/');
        $path = str_replace('//', '/', $path);
        $host = $this->resolveHostName($version);

        // add query to compress response as gzip
        if ($gzip) {
            $path .= '?gzip=1';
        }

        // call API server and get response
        $response = $this->request($host . $path, $data);

        // get status code and content
        $statusCode = $response->getStatusCode();
        $content    = $this->getContents($response->getBody(), $gzip);

        // parse response content to assoc array
        $content = $this->parseContents($content, $statusCode < 300);

        // validate response status code
        $this->validateResponse($statusCode, $content, $shouldHaveStatus);

        // return response
        return $content;
    }

    /**
     * Get API response
     *
     * @param string             $url
     * @param array<mixed,mixed> $data
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

        // disable SSL verification
        if ($this->sslVerify === false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

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
        $response   = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // check for errors.
        if ($response === false) {
            throw new RuntimeException(curl_error($ch), curl_errno($ch));
        }

        // close curl
        curl_close($ch);

        return new Response((int) $statusCode, [], (string) $response);
    }

    /**
     * Decode API response JSON to array
     *
     * @param string $content
     * @param bool   $throwOnError
     *
     * @return array<mixed,mixed>
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    private function parseContents(string $content, bool $throwOnError): array
    {
        try {
            return $this->decode($content);
        } catch (JsonException $exception) {
            if ($throwOnError) {
                throw new BadRequestException([], 400, $exception, 'Cannot parse response data');
            }

            return [];
        }
    }

    /**
     * Decode API response JSON to array
     *
     * @param string $content
     *
     * @return array<mixed,mixed>
     *
     * @throws \JsonException
     */
    protected function decode(string $content): array
    {
        return json_decode($content, true, flags: JSON_THROW_ON_ERROR);
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
        return API::URL[$version] ?? API::URL[API::V2V1];
    }

    /**
     * Get response content (even gzipped)
     *
     * @param \Psr\Http\Message\StreamInterface $stream
     * @param bool                              $gzip
     *
     * @return string
     */
    private function getContents(StreamInterface $stream, bool $gzip): string
    {
        if ($gzip === false) {
            return $stream->getContents();
        }

        try {
            $inflateStream = new InflateStream($stream);

            return $inflateStream->getContents();
        } catch (Throwable) {
            $stream->rewind();

            return $stream->getContents();
        }
    }

    /**
     * Validate response
     *
     * @param int                $statusCode
     * @param array<mixed,mixed> $response
     * @param bool               $shouldHaveStatus
     *
     * @throws \Inspirum\Balikobot\Contracts\ExceptionInterface
     */
    private function validateResponse(int $statusCode, array $response, bool $shouldHaveStatus): void
    {
        $this->validator->validateStatus($statusCode, $response);

        $this->validator->validateResponseStatus($response, null, $shouldHaveStatus);
    }
}
