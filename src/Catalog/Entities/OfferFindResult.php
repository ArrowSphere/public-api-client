<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class OfferFindResult
 */
class OfferFindResult extends AbstractOffer
{
    public const COLUMN_HIGHLIGHT = 'highlight';

    public const COLUMN_ID = 'id';

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_HIGHLIGHT, type: 'array')]
    protected array $highlight = [];

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ID, required: true)]
    protected string $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getHighlight(): array
    {
        return $this->highlight;
    }
}
