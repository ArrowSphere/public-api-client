<?php

namespace ArrowSphere\PublicApiClient\Catalog\Entities;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_CONVERSION_SKUS => 'array',
        self::COLUMN_IS_ENABLED      => 'required',
        self::COLUMN_RELATED_OFFERS  => 'array',
    ];

    /** @var string|null */
    private $buyingProgram;

    /** @var string[]|null */
    private $conversionSkus;

    /** @var string|null */
    private $description;

    /** @var string|null */
    private $endCustomerFeatures;

    /** @var string|null */
    private $eula;

    /** @var string|null */
    private $featuresPicture;

    /** @var string|null */
    private $fullFeatures;

    /** @var bool */
    private $isEnabled;

    /** @var string|null */
    private $orderableSku;

    /** @var string[] */
    private $relatedOffers;

    /** @var string|null */
    private $requirements;

    /** @var string|null */
    private $serviceDescription;

    /** @var string|null */
    private $shortFeatures;

    /**
     * Offer constructor.
     *
     * @param array $data
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->buyingProgram = $data[self::COLUMN_BUYING_PROGRAM] ?? null;
        $this->conversionSkus = $data[self::COLUMN_CONVERSION_SKUS] ?? null;
        $this->description = $data[self::COLUMN_DESCRIPTION] ?? null;
        $this->endCustomerFeatures = $data[self::COLUMN_END_CUSTOMER_FEATURES] ?? null;
        $this->eula = $data[self::COLUMN_EULA] ?? null;
        $this->featuresPicture = $data[self::COLUMN_FEATURES_PICTURE] ?? null;
        $this->fullFeatures = $data[self::COLUMN_FULL_FEATURES] ?? null;
        $this->isEnabled = $data[self::COLUMN_IS_ENABLED];
        $this->orderableSku = $data[self::COLUMN_ORDERABLE_SKU] ?? null;
        $this->relatedOffers = $data[self::COLUMN_RELATED_OFFERS] ?? [];
        $this->requirements = $data[self::COLUMN_REQUIREMENTS] ?? null;
        $this->serviceDescription = $data[self::COLUMN_SERVICE_DESCRIPTION] ?? null;
        $this->shortFeatures = $data[self::COLUMN_SHORT_FEATURES] ?? null;
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
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            self::COLUMN_BUYING_PROGRAM        => $this->getBuyingProgram(),
            self::COLUMN_CONVERSION_SKUS       => $this->getConversionSkus(),
            self::COLUMN_DESCRIPTION           => $this->getDescription(),
            self::COLUMN_END_CUSTOMER_FEATURES => $this->getEndCustomerFeatures(),
            self::COLUMN_EULA                  => $this->getEula(),
            self::COLUMN_IS_ENABLED            => $this->getIsEnabled(),
            self::COLUMN_IS_PROGRAM_ENABLED    => $this->getProgramIsEnabled(),
            self::COLUMN_ORDERABLE_SKU         => $this->getOrderableSku(),
            self::COLUMN_RELATED_OFFERS        => $this->getRelatedOffers(),
            self::COLUMN_SERVICE_DESCRIPTION   => $this->getServiceDescription(),
            self::COLUMN_FEATURES_PICTURE      => $this->getFeaturesPicture(),
            self::COLUMN_FULL_FEATURES         => $this->getFullFeatures(),
            self::COLUMN_REQUIREMENTS          => $this->getRequirements(),
            self::COLUMN_SHORT_FEATURES        => $this->getShortFeatures(),
        ]);
    }
}
