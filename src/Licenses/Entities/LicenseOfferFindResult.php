<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
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

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_LICENSE   => 'required',
        self::COLUMN_HIGHLIGHT => 'array',
    ];

    /**
     * @var array
     */
    private $highlight;

    /**
     * @var License
     */
    private $license;

    /**
     * @var Offer|null
     */
    private $offer;

    /**
     * LicenseOfferFindResult constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->highlight = $data[self::COLUMN_HIGHLIGHT] ?? [];
        $this->license = new License($data[self::COLUMN_LICENSE]);

        if (isset($data[self::COLUMN_OFFER])) {
            $this->offer = new Offer($data[self::COLUMN_OFFER]);
        }
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(
            [
            self::COLUMN_HIGHLIGHT => $this->getHighlight(),
            self::COLUMN_LICENSE   => $this->getLicense()->jsonSerialize()
            ],
            $this->getOffer() === null ? [] : [self::COLUMN_OFFER     => $this->getOffer()->jsonSerialize()]
        );
    }
}
