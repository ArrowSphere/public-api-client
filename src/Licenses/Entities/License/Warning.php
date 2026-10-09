<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
    private $key;

    /**
     * @var string
     */
    private $message;

    /**
     * Warning constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->key = $data[self::COLUMN_KEY];
        $this->message = $data[self::COLUMN_MESSAGE];
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_KEY     => $this->key,
            self::COLUMN_MESSAGE => $this->message,
        ];
    }
}
