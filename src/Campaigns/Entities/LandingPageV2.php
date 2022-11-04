<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageBody;
use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageFooterV2;
use ArrowSphere\PublicApiClient\Campaigns\Entities\LandingPage\LandingPageHeader;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

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
    private $url;

    /**
     * @var LandingPageHeader
     */
    private $header;

    /**
     * @var LandingPageBody
     */
    private $body;

    /**
     * @var LandingPageFooterV2
     */
    private $footer;

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

        $this->url = $data[self::COLUMN_URL] ?? self::DEFAULT_VALUE_URL;
        $this->header = new LandingPageHeader($data[self::COLUMN_HEADER] ?? []);
        $this->body = new LandingPageBody($data[self::COLUMN_BODY] ?? []);
        $this->footer = new LandingPageFooterV2($data[self::COLUMN_FOOTER] ?? []);
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_URL    => $this->getUrl(),
            self::COLUMN_HEADER => $this->getHeader(),
            self::COLUMN_BODY   => $this->getBody(),
            self::COLUMN_FOOTER => $this->getFooter(),
        ];
    }
}
