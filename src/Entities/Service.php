<?php

namespace ArrowSphere\PublicApiClient\Entities;

/**
 * Class Service
 *
 * @property string $reference
 * @property string $name
 * @property string $associatedSubscriptionProgram
 * @property string $description
 * @property string[] $serviceTags
 * @property string $logo
 * @property string $icon
 * @property string $program
 * @property string $category
 * @property Price[] $prices
 * @property string $orderableSku
 * @property string $features
 * @property string $endUserEula
 * @property string $endUserFeatures
 * @property string $endUserRequirements
 * @property string[] $keywords
 * @property object $links
 * @property string $vendor
 *
 * @deprecated replaced by Catalog\Entities\Service
 */
class Service
{
    /**
     * @var string
     */
    public $reference;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $associatedSubscriptionProgram;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string[]
     */
    public $serviceTags = [];

    /**
     * @var string
     */
    public $logo;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $program;

    /**
     * @var string
     */
    public $category;

    /**
     * @var Price[]
     */
    public $prices = [];

    /**
     * @var string
     */
    public $orderableSku;

    /**
     * @var string
     */
    public $features;

    /**
     * @var string
     */
    public $endUserEula;

    /**
     * @var string
     */
    public $endUserFeatures;

    /**
     * @var string
     */
    public $endUserRequirements;

    /**
     * @var string[]
     */
    public $keywords = [];

    /**
     * @var object
     */
    public $links;

    /**
     * @var string
     */
    public $vendor;

    public function __construct(array $data)
    {
        foreach ($data as $field => $value) {
            if (property_exists(self::class, $field)) {
                if ($field === 'price') {
                    $prices = [];
                    foreach ($value as $price) {
                        $prices[] = new Price($price);
                    }
                    $value = $prices;
                }
                $this->$field = $value;
            }
        }
    }
}
