<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\PreferenceGroupByColumnsEnum;
use ArrowSphere\PublicApiClient\Billing\Enum\PreferenceOverridesEnum;
use ArrowSphere\PublicApiClient\Billing\Enum\PreferenceTypeEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Preference extends AbstractEntity
{
    public const KEY_NAME = 'name';
    public const KEY_PRIORITY = 'priority';
    public const KEY_IDENTIFIER = 'identifier';
    public const KEY_PARAMETERS = 'parameters';
    public const KEY_COLUMNS = 'columns';
    public const KEY_FILTERS = 'filters';
    public const KEY_OVERRIDES = 'overrides';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::KEY_NAME => 'string|required',
        self::KEY_PRIORITY => 'numeric|required',
        self::KEY_IDENTIFIER => 'string|required',
        self::KEY_PARAMETERS => 'array|present',
        self::KEY_PARAMETERS . '.' . self::KEY_COLUMNS => 'array|required_if:' . self::KEY_IDENTIFIER . ',' . PreferenceTypeEnum::GROUP_BY,
        self::KEY_FILTERS => 'array|present',
        self::KEY_OVERRIDES => 'array|required',
        self::KEY_OVERRIDES . '.' . PreferenceOverridesEnum::ARS_SKU => 'string|required'
    ];

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var array
     */
    private $filters;

    /**
     * @var array
     */
    private $overrides;

    /**
     * Preferences constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (self::$enableValidation) {
            if (! PreferenceTypeEnum::isValidValue($data[self::KEY_IDENTIFIER])) {
                throw new EntityValidationException('Identifier: ' . $data[self::KEY_IDENTIFIER] . ' not supported');
            }

            if ($data[self::KEY_IDENTIFIER] === PreferenceTypeEnum::GROUP_BY) {
                $values = PreferenceGroupByColumnsEnum::invalidValues($data[self::KEY_PARAMETERS][self::KEY_COLUMNS]);

                if (! empty($values)) {
                    throw new EntityValidationException('GroupBy Columns: ' . implode(' ', $values) . ' not supported');
                }
            }
        }

        $this->name = $data[self::KEY_NAME];
        $this->priority = $data[self::KEY_PRIORITY];
        $this->identifier = $data[self::KEY_IDENTIFIER];
        $this->parameters = $data[self::KEY_PARAMETERS];
        $this->filters = $data[self::KEY_FILTERS];
        $this->overrides = $data[self::KEY_OVERRIDES];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @return array
     */
    public function getOverrides(): array
    {
        return $this->overrides;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::KEY_NAME => $this->getName(),
            self::KEY_PRIORITY => $this->getPriority(),
            self::KEY_IDENTIFIER => $this->getIdentifier(),
            self::KEY_PARAMETERS => $this->getParameters(),
            self::KEY_FILTERS => (object)$this->getFilters(),
            self::KEY_OVERRIDES => $this->getOverrides(),
        ];
    }
}
