<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

class Preferences extends AbstractEntity
{
    public const KEY_PREFERENCES = 'preferences';
    public const KEY_VALIDITY = 'validity';
    public const KEY_USABLE = 'usable';
    public const KEY_STATUS = 'status';

    /**
     * @var Preference[]
     */
    #[Property(name: self::KEY_PREFERENCES, type: Preference::class, isArray: true)]
    protected array $list = [];

    /**
     * @var bool The usable flag of the nested validity field, hydrated by the constructor
     */
    protected bool $usable;

    /**
     * @var string The status of the nested validity field, hydrated by the constructor
     */
    protected string $status;

    /**
     * Preferences constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $validity = $data[self::KEY_VALIDITY] ?? null;
        if (! is_array($validity) || ! isset($validity[self::KEY_USABLE], $validity[self::KEY_STATUS])) {
            throw new EntitiesException(static::class . ': Missing field: ' . self::KEY_VALIDITY);
        }

        $this->usable = (bool) $validity[self::KEY_USABLE];
        $this->status = (string) $validity[self::KEY_STATUS];
    }

    /**
     * @return Preference[]
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @return bool
     */
    public function getUsable(): bool
    {
        return $this->usable;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return parent::jsonSerialize() + [
            self::KEY_VALIDITY => [
                self::KEY_USABLE => $this->usable,
                self::KEY_STATUS => $this->status,
            ],
        ];
    }
}
