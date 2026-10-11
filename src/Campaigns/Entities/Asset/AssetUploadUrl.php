<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

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
    #[Property(name: self::COLUMN_UUID, required: true)]
    protected string $uuid;

    /**
     * @var AssetImage
     */
    #[Property(name: self::COLUMN_IMAGE, type: AssetImage::class, required: true)]
    protected AssetImage $image;

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
}
