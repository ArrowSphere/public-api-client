<?php

namespace ArrowSphere\PublicApiClient\Support;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

abstract class AbstractRequestBuilder
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @throws EntityValidationException
     */
    public function build(): array
    {
        $this->validate();

        return $this->data;
    }

    /**
     * @throws EntityValidationException
     */
    abstract protected function validate(): void;
}
