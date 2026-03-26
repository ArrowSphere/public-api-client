<?php

namespace ArrowSphere\PublicApiClient\Reports\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class ValidateReportOrder
 */
class ValidateReportOrder extends AbstractEntity
{
    /**
     * @var string
     */
    public const COLUMN_REFERENCE = 'reference';

    /**
     * @var string
     */
    public const COLUMN_LINK = 'link';

    /**
     * @var string
     */
    public const COLUMN_STATUS = 'status';

    #[Property(required: true)]
    protected string $reference;

    #[Property(required: true)]
    protected string $link;

    #[Property(required: true)]
    protected string $status;

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
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
