<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Licenses\Entities\License\License;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\Offer;

/**
 * Class LicenseOfferFindResult
 */
class LicenseOfferFindResult extends AbstractEntity
{
    public const COLUMN_HIGHLIGHT = 'highlight';

    public const COLUMN_LICENSE = 'license';

    public const COLUMN_OFFER = 'offer';

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_HIGHLIGHT, type: 'array')]
    protected array $highlight = [];

    /**
     * @var License
     */
    #[Property(name: self::COLUMN_LICENSE, type: License::class, required: true)]
    protected License $license;

    /**
     * @var Offer|null
     */
    #[Property(name: self::COLUMN_OFFER, type: Offer::class)]
    protected ?Offer $offer = null;

    /**
     * @return array
     */
    public function getHighlight(): array
    {
        return $this->highlight;
    }

    /**
     * @return License
     */
    public function getLicense(): License
    {
        return $this->license;
    }

    /**
     * @return Offer|null
     */
    public function getOffer(): ?Offer
    {
        return $this->offer;
    }
}
