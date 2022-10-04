<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\AbstractEntity;

/**
 * Class AssetUploadUrl
 */
class AssetUploadUrl extends AbstractEntity
{
    public const COLUMN_UUID = 'uuid';

    public const COLUMN_IMAGE = 'image';

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var AssetImage
     */
    private $image;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->uuid = $data[self::COLUMN_UUID];
        $this->image = new AssetImage($data[self::COLUMN_IMAGE]);
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return AssetImage
     */
    public function getImage(): AssetImage
    {
        return $this->image;
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_UUID  => $this->uuid,
            self::COLUMN_IMAGE => $this->image,
        ];
    }
}
