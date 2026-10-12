<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Offer
 */
class Offer extends AbstractOffer
{
    public const COLUMN_BUYING_PROGRAM = 'buying_program';

    public const COLUMN_CONVERSION_SKUS = 'conversion_skus';

    public const COLUMN_DESCRIPTION = 'description';

    public const COLUMN_END_CUSTOMER_FEATURES = 'end_customer_features';

    public const COLUMN_EULA = 'eula';

    public const COLUMN_FEATURES_PICTURE = 'features_picture';

    public const COLUMN_FULL_FEATURES = 'full_features';

    public const COLUMN_IS_ENABLED = 'isEnabled';

    public const COLUMN_IS_PROGRAM_ENABLED = 'program.isEnabled';

    public const COLUMN_ORDERABLE_SKU = 'orderable_sku';

    public const COLUMN_REQUIREMENTS = 'requirements';

    public const COLUMN_RELATED_OFFERS = 'related_offers';

    public const COLUMN_SERVICE_DESCRIPTION = 'service_description';

    public const COLUMN_SHORT_FEATURES = 'short_features';

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_BUYING_PROGRAM, serializeNull: true)]
    protected ?string $buyingProgram = null;

    /**
     * @var string[]|null
     */
    #[Property(name: self::COLUMN_CONVERSION_SKUS, isArray: true, serializeNull: true)]
    protected ?array $conversionSkus = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_DESCRIPTION, serializeNull: true)]
    protected ?string $description = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_END_CUSTOMER_FEATURES, serializeNull: true)]
    protected ?string $endCustomerFeatures = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_EULA, serializeNull: true)]
    protected ?string $eula = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_FEATURES_PICTURE, serializeNull: true)]
    protected ?string $featuresPicture = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_FULL_FEATURES, serializeNull: true)]
    protected ?string $fullFeatures = null;

    /**
     * @var bool
     */
    #[Property(name: self::COLUMN_IS_ENABLED, type: 'bool', required: true)]
    protected bool $isEnabled;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_ORDERABLE_SKU, serializeNull: true)]
    protected ?string $orderableSku = null;

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_RELATED_OFFERS, type: 'array')]
    protected array $relatedOffers = [];

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_REQUIREMENTS, serializeNull: true)]
    protected ?string $requirements = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SERVICE_DESCRIPTION, serializeNull: true)]
    protected ?string $serviceDescription = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SHORT_FEATURES, serializeNull: true)]
    protected ?string $shortFeatures = null;

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
        if (($data[self::COLUMN_CONVERSION_SKUS] ?? null) === []) {
            $this->conversionSkus = [];
        }
    }

    /**
     * @return string|null
     */
    public function getBuyingProgram(): ?string
    {
        return $this->buyingProgram;
    }

    /**
     * @return string[]|null
     */
    public function getConversionSkus(): ?array
    {
        return $this->conversionSkus;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getEndCustomerFeatures(): ?string
    {
        return $this->endCustomerFeatures;
    }

    /**
     * @return string|null
     */
    public function getEula(): ?string
    {
        return $this->eula;
    }

    /**
     * @return string|null
     */
    public function getFeaturesPicture(): ?string
    {
        return $this->featuresPicture;
    }

    /**
     * @return string|null
     */
    public function getFullFeatures(): ?string
    {
        return $this->fullFeatures;
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
    public function getOrderableSku(): ?string
    {
        return $this->orderableSku;
    }

    /**
     * @return string[]
     */
    public function getRelatedOffers(): array
    {
        return $this->relatedOffers;
    }

    /**
     * @return string|null
     */
    public function getRequirements(): ?string
    {
        return $this->requirements;
    }

    /**
     * @return string|null
     */
    public function getServiceDescription(): ?string
    {
        return $this->serviceDescription;
    }

    /**
     * @return string|null
     */
    public function getShortFeatures(): ?string
    {
        return $this->shortFeatures;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        // The nested program.isEnabled field is serialized under a dotted key
        return parent::jsonSerialize() + [
            self::COLUMN_IS_PROGRAM_ENABLED => $this->getProgramIsEnabled(),
        ];
    }
}
