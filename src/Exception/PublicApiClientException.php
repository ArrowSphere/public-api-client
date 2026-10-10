<?php

namespace ArrowSphere\PublicApiClient\Exception;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * Class PublicApiClientException
 */
class PublicApiClientException extends Exception
{
    /**
     * @var ResponseInterface|null The HTTP response that caused the exception, if any
     */
    private ?ResponseInterface $response;

    /**
     * PublicApiClientException constructor.
     *
     * @param string $message
     * @param int $code The HTTP status code when the exception is caused by an HTTP response
     * @param Throwable|null $previous
     * @param ResponseInterface|null $response The HTTP response that caused the exception, if any
     */
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null, ?ResponseInterface $response = null)
    {
        parent::__construct($message, $code, $previous);

        $this->response = $response;
    }

    /**
     * Returns the HTTP response that caused the exception, if any.
     *
     * @return ResponseInterface|null
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
