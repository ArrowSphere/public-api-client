<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
    private $name;

    /**
     * @var string
     */
    private $scope;

    /**
     * @var string
     */
    private $state;

    /**
     * Config constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->name = $data[self::COLUMN_NAME];
        $this->scope = $data[self::COLUMN_SCOPE];
        $this->state = $data[self::COLUMN_STATE];
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_NAME  => $this->name,
            self::COLUMN_SCOPE => $this->scope,
            self::COLUMN_STATE => $this->state,
        ];
    }
}
