<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class LandingPageMarketingFeature extends AbstractEntity
{
    public const COLUMN_DESCRIPTION = 'description';
    public const COLUMN_TITLE = 'title';
    public const COLUMN_ITEMS = 'items';

    public const DEFAULT_VALUE_DESCRIPTION = '';
    public const DEFAULT_VALUE_TITLE = '';

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var LandingPageMarketingFeatureItem[]
     */
    private $items;

    /**
     * Statement constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->title = $data[self::COLUMN_TITLE] ?? self::DEFAULT_VALUE_TITLE;
        $this->description = $data[self::COLUMN_DESCRIPTION] ?? self::DEFAULT_VALUE_DESCRIPTION;
        $this->items = array_map(
            static function (array $items) {
                return new LandingPageMarketingFeatureItem($items);
            },
            $data[self::COLUMN_ITEMS] ?? []
        );
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_TITLE       => $this->getTitle(),
            self::COLUMN_DESCRIPTION => $this->getDescription(),
            self::COLUMN_ITEMS       => $this->getItems(),
        ];
    }
}
