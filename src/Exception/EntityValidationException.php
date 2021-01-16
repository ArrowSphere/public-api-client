<?php

namespace ArrowSphere\PublicApiClient\Exception;

/**
 * Class EntityValidationException
 */
class EntityValidationException extends PublicApiClientException
{
    public function __construct($message)
    {
        parent::__construct(is_array($message) ? implode('; ', $message) : $message);
    }
}
