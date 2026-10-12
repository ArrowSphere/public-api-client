<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Warning
 */
class Warning extends AbstractEntity
{
    public const COLUMN_KEY = 'key';

    public const COLUMN_MESSAGE = 'message';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_KEY, required: true)]
    protected string $key;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_MESSAGE, required: true)]
    protected string $message;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
