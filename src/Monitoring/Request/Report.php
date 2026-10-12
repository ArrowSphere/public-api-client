<?php

namespace ArrowSphere\PublicApiClient\Monitoring\Request;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;

class Report extends AbstractEntity
{
    public const COLUMN_BODY = 'body';
    public const COLUMN_URL = 'url';
    public const COLUMN_TYPE = 'type';
    public const COLUMN_USER_AGENT = 'userAgent';

    /**
     * @var array
     */
    #[Property(isArray: true, required: true)]
    protected array $body;

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $url;

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $type;

    /**
     * @var string
     */
    #[Property(required: true)]
    protected string $userAgent;

    /**
     * @param array{
     *     body: array,
     *     type: string,
     *     url: string,
     *     userAgent: string,
     * } $data
     *
     * @throws EntitiesException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }
}
