<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

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
