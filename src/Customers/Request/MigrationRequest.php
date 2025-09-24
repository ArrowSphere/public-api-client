<?php

namespace ArrowSphere\PublicApiClient\Customers\Request;

use ArrowSphere\PublicApiClient\Customers\Request\SubEntities\Attributes;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class MigrationRequest extends AbstractEntity
{
    public const COLUMN_PROGRAM = 'program';
    public const COLUMN_ATTRIBUTES = 'attributes';

    #[Property(required: true)]
    protected string $program;

    #[Property(type: Attributes::class, isArray: true, required: true)]
    protected array $attributes;

    /**
     * @param array{
     *     program: string,
     *     attributes: array{
     *      array{
     *       name: string,
     *       value: string
     *      }
     *    }
     * } $data
     *
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
