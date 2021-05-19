<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\PreferenceGroupByColumnsEnum;
use ArrowSphere\PublicApiClient\Billing\Enum\PreferenceTypeEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class Preference extends AbstractEntity
{
    public const KEY_IDENTIFIER = 'identifier';
    public const KEY_PARAMETERS = 'parameters';
    public const KEY_COLUMNS = 'columns';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::KEY_IDENTIFIER => 'string|required',
        self::KEY_PARAMETERS => 'array|present',
        self::KEY_PARAMETERS . '.' . self::KEY_COLUMNS => 'array|required_if:' . self::KEY_IDENTIFIER . ',' . PreferenceTypeEnum::GROUP_BY,
    ];

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var array
     */
    private $parameters;

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

        if (! PreferenceTypeEnum::isValidValue($data[self::KEY_IDENTIFIER])) {
            throw new EntityValidationException('Identifier: ' . $data[self::KEY_IDENTIFIER] . ' not supported');
        }

        if ($data[self::KEY_IDENTIFIER] === PreferenceTypeEnum::GROUP_BY) {
            $values = PreferenceGroupByColumnsEnum::invalidValues($data[self::KEY_PARAMETERS][self::KEY_COLUMNS]);

            if (! empty($values)) {
                throw new EntityValidationException('GroupBy Columns: ' . implode(' ', $values) . ' not supported');
            }
        }

        $this->identifier = $data[self::KEY_IDENTIFIER];
        $this->parameters = $data[self::KEY_PARAMETERS];
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
    public function jsonSerialize(): array
    {
        return [
            self::KEY_IDENTIFIER => $this->getIdentifier(),
            self::KEY_PARAMETERS => $this->getParameters(),
        ];
    }
}
