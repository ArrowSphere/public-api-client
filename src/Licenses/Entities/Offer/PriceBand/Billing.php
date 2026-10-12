<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Billing
 */
class Billing extends AbstractEntity
{
    public const COLUMN_CYCLE = 'cycle';

    public const COLUMN_TERM = 'term';

    public const COLUMN_TYPE = 'type';

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_CYCLE, type: 'int', required: true)]
    protected int $cycle;

    /**
     * @var int
     */
    #[Property(name: self::COLUMN_TERM, type: 'int', required: true)]
    protected int $term;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_TYPE, required: true)]
    protected string $type;

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
}
