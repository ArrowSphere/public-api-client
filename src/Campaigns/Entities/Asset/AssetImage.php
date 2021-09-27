<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
    private $url;

    /**
     * @var AssetImageFields
     */
    private $fields;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->url = $data[self::COLUMN_URL];
        $this->fields = new AssetImageFields($data[self::COLUMN_FIELDS]);
    }

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

    public function jsonSerialize()
    {
        return [
            self::COLUMN_URL    => $this->url,
            self::COLUMN_FIELDS => $this->fields,
        ];
    }
}
