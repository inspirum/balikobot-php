<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Exception;

use Inspirum\Balikobot\Definitions\Response;
use Throwable;
use function is_array;
use function is_numeric;

final class BadRequestException extends BaseException
{
    /**
     * BadRequestException constructor
     *
     * @param array<mixed> $response
     */
    public function __construct(
        array $response,
        int $statusCode = 400,
        ?Throwable $previous = null,
        ?string $message = null,
    ) {
        $this->setErrors($response);

        parent::__construct($response, $statusCode, $previous, $message);
    }

    /**
     * Set errors from response
     *
     * @param array<mixed> $response
     */
    private function setErrors(array $response): void
    {
        $i = 0;

        $packages = $this->resolveErrorsData($response);

        // add errors from all packages
        while (isset($packages[$i])) {
            if (is_array($packages[$i])) {
                $this->setErrorsForPackage($i, $packages[$i]);
            } elseif (is_numeric($packages[$i]) && $packages[$i] >= 400) {
                $this->setError($i, 'status', $this->getErrorMessage('status', (int) $packages[$i]));
            } else {
                $this->setError($i, 'status', 'Nespecifikovaná chyba.');
            }

            // try next package
            $i++;
        }
    }

    /**
     * Resolve errors data array
     *
     * @param array<mixed> $response
     *
     * @return array<mixed>
     */
    private function resolveErrorsData(array $response): array
    {
        if (isset($response['packages'])) {
            return $response['packages'];
        }

        if (isset($response['errors'])) {
            return $response['errors'];
        }

        return $response;
    }

    /**
     * Set errors for package
     *
     * @param array<mixed> $response
     */
    private function setErrorsForPackage(int $number, array $response): void
    {
        // response does not have full errors
        if (isset($response['errors']) === false) {
            // try to resolve errors from codes
            $this->setErrorsFromResponseCodes($number, $response);

            return;
        }

        // set errors for given package
        foreach ($response['errors'] as $error) {
            $this->setError($number, $error['attribute'], $error['message']);
        }
    }

    /**
     * Set errors from codes
     *
     * @param array<string,int|string> $response
     */
    private function setErrorsFromResponseCodes(int $number, array $response): void
    {
        foreach ($response as $key => $code) {
            // skip non-numeric codes
            if (is_numeric($code) === false || $code < 400) {
                continue;
            }

            // set errors from given package from response codes
            $this->setError($number, $key, $this->getErrorMessage($key, (int) $code));
        }
    }

    /**
     * Get error message from variables
     */
    private function getErrorMessage(string $key, int $code): string
    {
        // get error message from code
        if ($key === 'status') {
            return Response::STATUS_CODE_ERRORS[$code] ?? Response::STATUS_CODE_ERRORS[500];
        }

        if (isset(Response::PACKAGE_DATA_KEY_ERRORS[$code][$key])) {
            return Response::PACKAGE_DATA_KEY_ERRORS[$code][$key];
        }

        return Response::PACKAGE_DATA_ERRORS[$code] ?? 'Nespecifikovaná chyba.';
    }

    /**
     * Set new error message
     */
    private function setError(int $number, string $key, string $error): void
    {
        $this->errors[$number][$key] = $error;
    }
}
