<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class LicenseFindResult
 */
class LicenseFindResult extends AbstractLicense
{
    public const COLUMN_HIGHLIGHT = 'highlight';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_HIGHLIGHT => 'array',
    ];

    /** @var array */
    private $highlight;

    /**
     * OfferFindResult constructor.
     *
     * @param array $data
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->highlight = $data[self::COLUMN_HIGHLIGHT] ?? [];
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
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            self::COLUMN_HIGHLIGHT => $this->getHighlight(),
        ]);
    }
}
