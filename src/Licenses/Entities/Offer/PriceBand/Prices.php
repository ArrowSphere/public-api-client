<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Prices
 */
class Prices extends AbstractEntity
{
    public const COLUMN_BUY = 'buy';

    public const COLUMN_SELL = 'sell';

    public const COLUMN_PUBLIC = 'public';

    protected const VALIDATION_RULES = [
        self::COLUMN_BUY    => 'required|numeric',
        self::COLUMN_SELL   => 'required|numeric',
        self::COLUMN_PUBLIC => 'required|numeric',
    ];

    /**
     * @var float
     */
    private $buy;

    /**
     * @var float
     */
    private $sell;

    /**
     * @var float
     */
    private $public;

    /**
     * Prices constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->buy = $data[self::COLUMN_BUY];
        $this->sell = $data[self::COLUMN_SELL];
        $this->public = $data[self::COLUMN_PUBLIC];
    }

    /**
     * @return float
     */
    public function getBuy(): float
    {
        return $this->buy;
    }

    /**
     * @return float
     */
    public function getSell(): float
    {
        return $this->sell;
    }

    /**
     * @return float
     */
    public function getPublic(): float
    {
        return $this->public;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BUY    => $this->getBuy(),
            self::COLUMN_SELL   => $this->getSell(),
            self::COLUMN_PUBLIC => $this->getPublic(),
        ];
    }
}
