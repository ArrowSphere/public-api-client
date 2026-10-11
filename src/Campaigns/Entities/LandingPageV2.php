<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageBody;
use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageFooterV2;
use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageHeader;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

class LandingPageV2 extends AbstractEntity
{
    public const COLUMN_URL = 'url';
    public const COLUMN_HEADER = 'header';
    public const COLUMN_BODY = 'body';
    public const COLUMN_FOOTER = 'footer';

    public const DEFAULT_VALUE_URL = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_URL, serializeNull: true)]
    protected ?string $url = self::DEFAULT_VALUE_URL;

    /**
     * @var LandingPageHeader
     */
    #[Property(name: self::COLUMN_HEADER, type: LandingPageHeader::class, required: true)]
    protected LandingPageHeader $header;

    /**
     * @var LandingPageBody
     */
    #[Property(name: self::COLUMN_BODY, type: LandingPageBody::class, required: true)]
    protected LandingPageBody $body;

    /**
     * @var LandingPageFooterV2
     */
    #[Property(name: self::COLUMN_FOOTER, type: LandingPageFooterV2::class, required: true)]
    protected LandingPageFooterV2 $footer;

    /**
     * LandingPageV2 constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        // A missing or empty part gets an instance with its default values, as an empty array would be considered as missing
        if (empty($data[self::COLUMN_HEADER])) {
            $data[self::COLUMN_HEADER] = new LandingPageHeader([]);
        }

        if (empty($data[self::COLUMN_BODY])) {
            $data[self::COLUMN_BODY] = new LandingPageBody([]);
        }

        if (empty($data[self::COLUMN_FOOTER])) {
            $data[self::COLUMN_FOOTER] = new LandingPageFooterV2([]);
        }

        parent::__construct($data);
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return LandingPageHeader
     */
    public function getHeader(): LandingPageHeader
    {
        return $this->header;
    }

    /**
     * @return LandingPageBody
     */
    public function getBody(): LandingPageBody
    {
        return $this->body;
    }

    /**
     * @return LandingPageFooterV2
     */
    public function getFooter(): LandingPageFooterV2
    {
        return $this->footer;
    }
}
