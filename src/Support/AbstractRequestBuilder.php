<?php

namespace ArrowSphere\PublicApiClient\Support;

abstract class AbstractRequestBuilder
{
    /**
     * @var array
     */
    protected $data;

    /**
     */
    public function build(): array
    {
        $this->validate();

        return $this->data;
    }

    /**
     */
    abstract protected function validate(): void;
}
