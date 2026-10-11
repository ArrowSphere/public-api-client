<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity as LegacyAbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\PreferenceGroupByColumnsEnum;
use ArrowSphere\PublicApiClient\Billing\Enum\PreferenceTypeEnum;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;
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

    /**
     * @var string
     */
    #[Property(name: self::KEY_NAME, required: true)]
    protected string $name;

    /**
     * @var int
     */
    #[Property(name: self::KEY_PRIORITY, type: 'int', required: true)]
    protected int $priority;

    /**
     * @var string
     */
    #[Property(name: self::KEY_IDENTIFIER, required: true)]
    protected string $identifier;

    /**
     * @var array
     */
    #[Property(name: self::KEY_PARAMETERS, type: 'array')]
    protected array $parameters = [];

    /**
     * @var array
     */
    #[Property(name: self::KEY_FILTERS, type: 'array')]
    protected array $filters = [];

    /**
     * @var array
     */
    #[Property(name: self::KEY_OVERRIDES, type: 'array', required: true)]
    protected array $overrides;

    /**
     * Preference constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (LegacyAbstractEntity::$enableValidation) {
            if (! PreferenceTypeEnum::isValidValue($this->identifier)) {
                throw new EntityValidationException('Identifier: ' . $this->identifier . ' not supported');
            }

            if ($this->identifier === PreferenceTypeEnum::GROUP_BY) {
                if (empty($this->parameters[self::KEY_COLUMNS]) || ! is_array($this->parameters[self::KEY_COLUMNS])) {
                    throw new EntityValidationException(self::KEY_PARAMETERS . '.' . self::KEY_COLUMNS . ' is required if ' . self::KEY_IDENTIFIER . ' is equal to ' . PreferenceTypeEnum::GROUP_BY);
                }

                $values = PreferenceGroupByColumnsEnum::invalidValues($this->parameters[self::KEY_COLUMNS]);
                if (! empty($values)) {
                    throw new EntityValidationException('GroupBy Columns: ' . implode(' ', $values) . ' not supported');
                }
            }
        }
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
        $data = parent::jsonSerialize();

        // The filters are a map, serialized as an object even when empty
        $data[self::KEY_FILTERS] = (object) $this->filters;

        return $data;
    }
}
