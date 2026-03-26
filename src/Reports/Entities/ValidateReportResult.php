<?php

namespace ArrowSphere\PublicApiClient\Reports\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class ValidateReportResult
 */
class ValidateReportResult extends AbstractEntity
{
    /**
     * @var string
     */
    public const COLUMN_ORDERS = 'orders';

    #[Property(type: ValidateReportOrder::class, isArray: true, required: true)]
    protected array $orders;

    /**
     * @param array $data
     *
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @return ValidateReportOrder[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }
}
