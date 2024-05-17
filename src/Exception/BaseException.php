<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Exception;

use Inspirum\Balikobot\Definitions\Response;
use RuntimeException;
use Throwable;
use function implode;
use function json_encode;
use function sprintf;

abstract class BaseException extends RuntimeException implements Exception
{
    /**
     * Response data
     *
     * @var array<mixed>
     */
    protected array $response;

    /**
     * Response HTTP status code
     */
    protected int $statusCode;

    /**
     * API response errors
     *
     * @var array<array<string,string>>
     */
    protected array $errors = [];

    /**
     * AbstractException constructor
     *
     * @param array<mixed> $response
     */
    public function __construct(
        array $response = [],
        int $statusCode = 500,
        ?Throwable $previous = null,
        ?string $message = null,
    ) {
        // set response data
        $this->response = $response;

        // overwrite default HTTP status code
        $this->statusCode = $statusCode;

        // overwrite default message
        if ($message === null) {
            $message = Response::STATUS_CODE_ERRORS[$statusCode] ?? 'Operace neproběhla v pořádku.';
            $message = $this->getMessageWithErrors($message);
        }

        // construct exception
        parent::__construct($message, $statusCode, $previous);
    }

    /**
     * Get response HTTP status code
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get response as array
     *
     * @return array<mixed>
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * Get response as string
     */
    public function getResponseAsString(): string
    {
        return (string) json_encode($this->response);
    }

    /**
     * Get response errors
     *
     * @return array<array<string,string>>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get message with errors
     */
    private function getMessageWithErrors(string $message): string
    {
        $messages = [$message];

        foreach ($this->getErrors() as $i => $errors) {
            foreach ($errors as $key => $error) {
                $messages[] = sprintf('[%s][%s]: %s', $i, $key, $error);
            }
        }

        return implode("\n", $messages);
    }
}
