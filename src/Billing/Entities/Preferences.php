<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;

class Preferences extends AbstractEntity
{
    public const KEY_PREFERENCES = 'preferences';
    public const KEY_VALIDITY = 'validity';
    public const KEY_USABLE = 'usable';
    public const KEY_STATUS = 'status';

    /**
     * @var Preference[]
     */
    private $list;

    /**
     * @var bool
     */
    private $usable;

    /**
     * @var string
     */
    private $status;

    /**
     * Preferences constructor.
     *
     * @param array $data
     *
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->list = array_map(static function (array $preference) {
            return new Preference($preference);
        }, $data[self::KEY_PREFERENCES]);
        $this->usable = $data[self::KEY_VALIDITY][self::KEY_USABLE];
        $this->status = $data[self::KEY_VALIDITY][self::KEY_STATUS];
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
        return [
            self::KEY_PREFERENCES => array_map(static function (Preference $preference) {
                return $preference->jsonSerialize();
            }, $this->getList()),
            self::KEY_VALIDITY => [
                self::KEY_USABLE => $this->getUsable(),
                self::KEY_STATUS => $this->getStatus(),
            ],
        ];
    }
}
