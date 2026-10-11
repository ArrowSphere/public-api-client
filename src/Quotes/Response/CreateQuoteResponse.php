<?php

namespace ArrowSphere\PublicApiClient\Quotes\Response;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

class CreateQuoteResponse extends AbstractEntity
{
    public const COLUMN_LINK = 'link';
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_STATUS = 'status';

    /**
     * @var string Quote reference
     */
    #[Property(name: self::COLUMN_REFERENCE, required: true)]
    protected string $reference;

    /**
     * @var string Quote status
     */
    #[Property(name: self::COLUMN_STATUS, required: true)]
    protected string $status;

    /**
     * @var string Quote api link
     */
    #[Property(name: self::COLUMN_LINK, required: true)]
    protected string $link;

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}
