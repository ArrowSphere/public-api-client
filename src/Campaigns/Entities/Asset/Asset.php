<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\AbstractEntity;

/**
 * Class Asset
 */
class Asset extends AbstractEntity
{
    public const COLUMN_UUID = 'uuid';

    public const COLUMN_URL = 'url';

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $url;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->uuid = $data[self::COLUMN_UUID];
        $this->url = $data[self::COLUMN_URL];
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    public function jsonSerialize()
    {
        return [
            self::COLUMN_UUID => $this->uuid,
            self::COLUMN_URL  => $this->url,
        ];
    }
}
