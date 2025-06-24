<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Offer
 */
class Offer extends AbstractEntity
{
    public const COLUMN_ACTION_FLAGS = 'actionFlags';

    public const COLUMN_CLASSIFICATION = 'classification';

    public const COLUMN_IS_ENABLED = 'isEnabled';

    public const COLUMN_LAST_UPDATE = 'lastUpdate';

    public const COLUMN_NAME = 'name';

    public const COLUMN_PRICE_BAND = 'priceBand';

    public const COLUMN_ARROW_SUB_CATEGORIES = 'arrowSubCategories';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_ACTION_FLAGS           => 'required|array',
        self::COLUMN_CLASSIFICATION         => 'required|string',
        self::COLUMN_IS_ENABLED             => 'required|boolean',
        self::COLUMN_LAST_UPDATE            => 'required|string',
        self::COLUMN_NAME                   => 'required|string',
        self::COLUMN_PRICE_BAND             => 'required|array',
        self::COLUMN_ARROW_SUB_CATEGORIES   => 'required'
    ];

    /**
     * @var ActionFlags
     */
    private $actionFlags;

    /**
     * @var string
     */
    private $classification;

    /**
     * @var bool
     */
    private $isEnabled;

    /**
     * @var string|null
     */
    private $lastUpdate;

    /**
     * @var string
     */
    private $name;

    /**
     * @var PriceBand
     */
    private $priceBand;

    /**
     * @var array|null
     */
    private $arrowSubCategories;

    /**
     * Offer constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->actionFlags = new ActionFlags($data[self::COLUMN_ACTION_FLAGS]);
        $this->classification = $data[self::COLUMN_CLASSIFICATION];
        $this->isEnabled = $data[self::COLUMN_IS_ENABLED];
        $this->lastUpdate = $data[self::COLUMN_LAST_UPDATE];
        $this->name = $data[self::COLUMN_NAME];
        $this->priceBand = new PriceBand($data[self::COLUMN_PRICE_BAND]);
        $this->arrowSubCategories = $data[self::COLUMN_ARROW_SUB_CATEGORIES];
    }

    /**
     * @return ActionFlags
     */
    public function getActionFlags(): ActionFlags
    {
        return $this->actionFlags;
    }

    /**
     * @return string
     */
    public function getClassification(): string
    {
        return $this->classification;
    }

    /**
     * @return bool
     */
    public function getIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @return string|null
     */
    public function getLastUpdate(): ?string
    {
        return $this->lastUpdate;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return PriceBand
     */
    public function getPriceBand(): PriceBand
    {
        return $this->priceBand;
    }

    /**
     * @return array|null
     */
    public function getArrowSubCategories(): ?array
    {
        return $this->arrowSubCategories;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_ACTION_FLAGS           => $this->actionFlags->jsonSerialize(),
            self::COLUMN_CLASSIFICATION         => $this->classification,
            self::COLUMN_IS_ENABLED             => $this->isEnabled,
            self::COLUMN_LAST_UPDATE            => $this->lastUpdate,
            self::COLUMN_NAME                   => $this->name,
            self::COLUMN_PRICE_BAND             => $this->priceBand->jsonSerialize(),
            self::COLUMN_ARROW_SUB_CATEGORIES   => $this->arrowSubCategories
        ];
    }
}
