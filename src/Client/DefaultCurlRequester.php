<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Client;

use GuzzleHttp\Psr7\Response;
use Inspirum\Balikobot\Exception\BadRequestException;
use Inspirum\Balikobot\Exception\TransportException;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use function base64_encode;
use function count;
use function curl_errno;
use function curl_error;
use function curl_exec;
use function curl_getinfo;
use function curl_init;
use function curl_setopt;
use function json_encode;
use function sprintf;
use const CURLINFO_HTTP_CODE;
use const CURLOPT_CONNECTTIMEOUT;
use const CURLOPT_HEADER;
use const CURLOPT_HTTPHEADER;
use const CURLOPT_POST;
use const CURLOPT_POSTFIELDS;
use const CURLOPT_RETURNTRANSFER;
use const CURLOPT_SSL_VERIFYHOST;
use const CURLOPT_SSL_VERIFYPEER;
use const CURLOPT_TIMEOUT;
use const CURLOPT_URL;
use const JSON_THROW_ON_ERROR;

final class DefaultCurlRequester implements Requester
{
    public function __construct(
        private readonly string $apiUser,
        private readonly string $apiKey,
        private readonly bool $sslVerify = true,
        private readonly int $connectTimeout = 10,
        private readonly int $timeout = 300,
    ) {
    }

    /** @inheritDoc */
    public function request(string $url, array $data = []): ResponseInterface
    {
        // init curl
        $ch = curl_init();

        // set headers
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);

        // disable SSL verification
        if ($this->sslVerify === false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        // set data
        if (count($data) > 0) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->encode($data));
        }

        // set auth
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            sprintf('Authorization: Basic %s', base64_encode(sprintf('%s:%s', $this->apiUser, $this->apiKey))),
            'Content-Type: application/json',
        ]);

        // execute curl
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // check for errors.
        if ($response === false) {
            throw new TransportException(sprintf('cURL error %d: %s', curl_errno($ch), curl_error($ch)));
        }

        return new Response((int) $statusCode, [], (string) $response);
    }

    /**
     * @param array<mixed,mixed> $data
     *
     * @throws \Inspirum\Balikobot\Exception\BadRequestException
     */
    private function encode(array $data): string
    {
        try {
            return json_encode($data, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new BadRequestException([], 400, $exception, 'Cannot encode request data');
        }
    }
}
