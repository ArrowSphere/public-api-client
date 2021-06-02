<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Price
 */
class Price extends AbstractEntity
{
    public const COLUMN_BUY_PRICE = 'buy_price';

    public const COLUMN_LIST_PRICE = 'list_price';

    public const COLUMN_CURRENCY = 'currency';

    /**
     * @var float
     */
    private $buyPrice;

    /**
     * @var float
     */
    private $listPrice;

    /**
     * @var string|null
     */
    private $currency;

    protected const VALIDATION_RULES = [
        self::COLUMN_BUY_PRICE  => 'present|numeric',
        self::COLUMN_LIST_PRICE => 'present|numeric',
        self::COLUMN_CURRENCY   => 'present',
    ];

    /**
     * Price constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->buyPrice = $data[self::COLUMN_BUY_PRICE];
        $this->listPrice = $data[self::COLUMN_LIST_PRICE];
        $this->currency = $data[self::COLUMN_CURRENCY];
    }

    /**
     * @return float
     */
    public function getBuyPrice(): float
    {
        return $this->buyPrice;
    }

    /**
     * @return float
     */
    public function getListPrice(): float
    {
        return $this->listPrice;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_BUY_PRICE  => $this->buyPrice,
            self::COLUMN_CURRENCY   => $this->currency,
            self::COLUMN_LIST_PRICE => $this->listPrice,
        ];
    }
}
