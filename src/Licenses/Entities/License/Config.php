<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\License;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Config
 */
class Config extends AbstractEntity
{
    public const COLUMN_NAME = 'name';

    public const COLUMN_SCOPE = 'scope';

    public const COLUMN_STATE = 'state';

    protected const VALIDATION_RULES = [
        self::COLUMN_NAME  => 'required|string',
        self::COLUMN_SCOPE => 'required|string',
        self::COLUMN_STATE => 'required|string',
    ];

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
     *
     * @throws EntityValidationException
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
    public function jsonSerialize()
    {
        return [
            self::COLUMN_NAME  => $this->name,
            self::COLUMN_SCOPE => $this->scope,
            self::COLUMN_STATE => $this->state,
        ];
    }
}
