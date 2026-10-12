<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Config
 */
class Config extends AbstractEntity
{
    public const COLUMN_NAME = 'name';

    public const COLUMN_SCOPE = 'scope';

    public const COLUMN_STATE = 'state';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_SCOPE, required: true)]
    protected string $scope;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_STATE, required: true)]
    protected string $state;

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
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }
}
