<?php

namespace Inspirum\Balikobot\Exceptions;

use Inspirum\Balikobot\Contracts\ExceptionInterface;
use Inspirum\Balikobot\Definitions\Response;
use RuntimeException;
use Throwable;

abstract class AbstractException extends RuntimeException implements ExceptionInterface
{
    /**
     * Response data
     *
     * @var array<mixed>
     */
    protected $response;

    /**
     * Response HTTP status code
     *
     * @var int
     */
    protected $statusCode;

    /**
     * API response errors
     *
     * @var array<array<string,string>>
     */
    protected $errors = [];

    /**
     * AbstractException constructor
     *
     * @param array<mixed>    $response
     * @param int             $statusCode
     * @param \Throwable|null $previous
     * @param string|null     $message
     */
    public function __construct(
        array $response = [],
        int $statusCode = 500,
        Throwable $previous = null,
        string $message = null
    ) {
        // set response data
        $this->response = $response;

        // overwrite default HTTP status code
        $this->statusCode = $statusCode;

        // overwrite default message
        if ($message === null) {
            $message = Response::$statusCodesErrors[$statusCode] ?? 'Operace neproběhla v pořádku.';
            $message = $this->getMessageWithErrors($message);
        }

        // construct exception
        parent::__construct($message, $statusCode, $previous);
    }

    /**
     * Get response HTTP status code
     *
     * @return int
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
     *
     * @return string
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
     *
     * @param string $message
     *
     * @return string
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
