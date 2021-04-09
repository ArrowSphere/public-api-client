<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Billing
 */
class Billing extends AbstractEntity
{
    public const COLUMN_CYCLE = 'cycle';

    public const COLUMN_TERM = 'term';

    public const COLUMN_TYPE = 'type';

    protected const VALIDATION_RULES = [
        self::COLUMN_CYCLE => 'required|numeric',
        self::COLUMN_TERM  => 'required|numeric',
        self::COLUMN_TYPE  => 'required|string',
    ];

    /**
     * @var int
     */
    private $cycle;

    /**
     * @var int
     */
    private $term;

    /**
     * @var string
     */
    private $type;

    /**
     * Billing constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->cycle = $data[self::COLUMN_CYCLE];
        $this->term = $data[self::COLUMN_TERM];
        $this->type = $data[self::COLUMN_TYPE];
    }

    /**
     * @return int
     */
    public function getCycle(): int
    {
        return $this->cycle;
    }

    /**
     * @return int
     */
    public function getTerm(): int
    {
        return $this->term;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_CYCLE => $this->cycle,
            self::COLUMN_TERM  => $this->term,
            self::COLUMN_TYPE  => $this->type,
        ];
    }
}
