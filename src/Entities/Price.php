<?php


namespace ArrowSphere\PublicApiClient\Entities;

/**
 * Class Price
 *
 * @property int $min_quantity
 * @property int $max_quantity
 * @property float $recurring_buy_price
 * @property float $recurring_sell_price
 * @property string $term
 * @property string $unit_type
 * @property string $periodicity
 * @property string $recurring_time_unit
 * @property float $setup_buy_price
 * @property float $setup_sell_price
 * @property string $setup_time_unit
 * @property string $EUR
 * @property string $availability_date
 * @property string $expiry_date;
 *
 * @deprecated replaced by Catalog\Entities\PriceBand
 */
class Price
{
    /** @var int */
    public $min_quantity;

    /** @var string */
    public $max_quantity;

    /** @var float */
    public $recurring_buy_price;

    /** @var float */
    public $recurring_sell_price;

    /** @var string */
    public $term;

    /** @var string */
    public $unit_type;

    /** @var string */
    public $periodicity;

    /** @var string */
    public $recurring_time_unit;

    /** @var int */
    public $setup_buy_price;

    /** @var float */
    public $setup_sell_price;

    /** @var float */
    public $setup_time_unit;

    /** @var string */
    public $currency;

    /** @var string */
    public $availability_date;

    /** @var string */
    public $expiry_date;

    public function __construct(array $data)
    {
        foreach ($data as $field => $value) {
            if (property_exists(self::class, $field)) {
                $this->$field = $value;
            }
        }
    }
}
