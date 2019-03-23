<?php

namespace Inspirum\Balikobot\Exceptions;

use Inspirum\Balikobot\Definitions\Response;
use Throwable;

class BadRequestException extends AbstractException
{
    /**
     * BadRequestException constructor.
     *
     * @param array           $response
     * @param int             $statusCode
     * @param \Throwable|null $previous
     * @param string|null     $message
     */
    public function __construct(
        array $response,
        int $statusCode = 400,
        Throwable $previous = null,
        string $message = null
    ) {
        $this->setErrors($response);

        parent::__construct($response, $statusCode, $previous, $message);
    }

    /**
     * Set errors from response.
     *
     * @param array $response
     *
     * @return void
     */
    private function setErrors(array $response): void
    {
        $i = 0;

        // add erros from all packages
        while (isset($response[$i])) {
            // set errors for package
            $this->setErrorsForPackage($i, $response[$i]);

            // try next package
            $i++;
        }
    }

    /**
     * @param int   $number
     * @param array $response
     *
     * @return void
     */
    private function setErrorsForPackage(int $number, array $response): void
    {
        // response does not have full errors
        if (isset($response['errors']) === false) {
            // try to resolve errors from codes
            $this->setErrorsFromResponseCodes($number, $response);

            return;
        }

        // set erros for given package
        foreach ($response['errors'] as $error) {
            $this->setError($number, $error['attribute'], $error['message']);
        }
    }

    /**
     * @param int   $number
     * @param array $response
     *
     * @return void
     */
    private function setErrorsFromResponseCodes(int $number, array $response)
    {
        foreach ($response as $key => $code) {
            // skip non-numeric codes
            if (is_numeric($code) === false || $code < 400) {
                continue;
            }

            // get error message from code
            $error = $this->getErrorMessage($key, (int) $code);

            // set erros fro given package from response codes
            $this->setError($number, $key, $error);
        }
    }

    /**
     * @param string $key
     * @param int    $code
     *
     * @return string
     */
    private function getErrorMessage(string $key, int $code): string
    {
        // get error message from code
        if ($key === 'status') {
            return Response::$statusCodesErrors[$code] ?? Response::$statusCodesErrors[500];
        }

        if (isset(Response::$packageDataKeyErrors[$code][$key])) {
            return Response::$packageDataKeyErrors[$code][$key];
        }

        return Response::$packageDataErrors[$code] ?? 'Nespecifikovaná chyba.';
    }

    /**
     * @param int    $number
     * @param string $key
     * @param string $error
     *
     * @return void
     */
    private function setError(int $number, string $key, string $error): void
    {
        $this->errors[$number][$key] = $error;
    }
}
