<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

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
    #[Property(name: self::COLUMN_UUID, required: true)]
    protected string $uuid;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_URL, required: true)]
    protected string $url;

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
}
