<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers\Arrowsphere;

/**
 * Class SaleConstraints
 */
class Identifiers extends AbstractEntity
{
    public const COLUMN_ARROWSPHERE = 'arrowsphere';

    /**
     * @var Arrowsphere
     */
    private $arrowsphere;

    /**
     * SaleConstraints constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->arrowsphere = new Arrowsphere($data[self::COLUMN_ARROWSPHERE]);
    }

    /**
     * @return Arrowsphere
     */
    public function getArrowsphere(): Arrowsphere
    {
        return $this->arrowsphere;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_ARROWSPHERE => $this->arrowsphere->jsonSerialize(),
        ];
    }
}
