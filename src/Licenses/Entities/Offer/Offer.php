<?php

namespace ArrowSphere\PublicApiClient\Licenses\Entities\Offer;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

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

    /**
     * @var ActionFlags
     */
    #[Property(name: self::COLUMN_ACTION_FLAGS, type: ActionFlags::class, required: true)]
    protected ActionFlags $actionFlags;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CLASSIFICATION, required: true)]
    protected string $classification;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_ENABLED, type: 'bool', required: true)]
    protected bool $isEnabled;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_LAST_UPDATE, serializeNull: true)]
    protected ?string $lastUpdate = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_NAME, required: true)]
    protected string $name;

    /**
     * @var PriceBand
     */
    #[Property(name: self::COLUMN_PRICE_BAND, type: PriceBand::class, required: true)]
    protected PriceBand $priceBand;

    /**
     * @var string[]|null
     */
    #[Property(name: self::COLUMN_ARROW_SUB_CATEGORIES, isArray: true, serializeNull: true)]
    protected ?array $arrowSubCategories = null;

    /**
     * Offer constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        // An empty list stays an empty list, the attribute hydration would consider it as missing
        if (($data[self::COLUMN_ARROW_SUB_CATEGORIES] ?? null) === []) {
            $this->arrowSubCategories = [];
        }
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
}
