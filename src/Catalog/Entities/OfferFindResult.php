<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class OfferFindResult
 */
class OfferFindResult extends AbstractOffer
{
    public const COLUMN_HIGHLIGHT = 'highlight';

    public const COLUMN_ID = 'id';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_HIGHLIGHT => 'array',
        self::COLUMN_ID        => 'required',
    ];

    /**
     * @var array
     */
    private $highlight;

    /**
     * @var string
     */
    private $id;

    /**
     * OfferFindResult constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->highlight = $data[self::COLUMN_HIGHLIGHT] ?? [];
        $this->id = $data[self::COLUMN_ID];
    }

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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'highlight' => $this->getHighlight(),
            'id'        => $this->getId(),
        ]);
    }
}
