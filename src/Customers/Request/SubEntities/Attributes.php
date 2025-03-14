<?php

namespace ArrowSphere\PublicApiClient\Customers\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Attributes extends AbstractEntity
{
    public const COLUMN_SCHEDULED_NAME = 'name';
    public const COLUMN_VALUE = 'value';

    #[Property(required: true)]
    protected string $name;

    #[Property(required: true)]
    protected string $value;

    /**
     * @param array{
     *     name: string,
     *     value: string
     * } $data
     *
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
