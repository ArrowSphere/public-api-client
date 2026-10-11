<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class AssetImage
 */
class AssetImage extends AbstractEntity
{
    public const COLUMN_URL = 'url';

    public const COLUMN_FIELDS = 'fields';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_URL, required: true)]
    protected string $url;

    /**
     * @var AssetImageFields
     */
    #[Property(name: self::COLUMN_FIELDS, type: AssetImageFields::class, required: true)]
    protected AssetImageFields $fields;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return AssetImageFields
     */
    public function getFields(): AssetImageFields
    {
        return $this->fields;
    }
}
