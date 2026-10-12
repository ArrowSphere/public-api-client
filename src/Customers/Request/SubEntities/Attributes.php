<?php

namespace ArrowSphere\PublicApiClient\Customers\Request\SubEntities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class Attributes extends AbstractEntity
{
    public const COLUMN_SCHEDULED_NAME = 'name';
    public const COLUMN_VALUE = 'value';

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $name;

    /**
     * @var string
     */
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
