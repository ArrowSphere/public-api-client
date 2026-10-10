<?php

namespace ArrowSphere\PublicApiClient;

/**
 * Class AbstractEntity
 */
abstract class AbstractEntity implements \JsonSerializable
{
    /**
     * AbstractEntity constructor.
     *
     * @param array $data
     */
    public function __construct(array $data) // @phpstan-ignore constructor.unusedParameter (entities without a constructor of their own still take the data array)
    {
    }
}
