<?php

namespace ArrowSphere\PublicApiClient\Quotes\Response;

use ArrowSphere\PublicApiClient\AbstractEntity;

class CreateQuoteResponse extends AbstractEntity
{
    public const COLUMN_LINK = 'link';
    public const COLUMN_REFERENCE = 'reference';
    public const COLUMN_STATUS = 'status';

    /**
     * @var string Quote api link
     */
    protected string $link;

    /**
     * @var string Quote reference
     */
    protected string $reference;

    /**
     * @var string Quote status
     */
    protected string $status;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->reference = $data[self::COLUMN_REFERENCE];
        $this->status = $data[self::COLUMN_STATUS];
        $this->link = $data[self::COLUMN_LINK];
    }

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_REFERENCE => $this->reference,
            self::COLUMN_STATUS => $this->status,
            self::COLUMN_LINK => $this->link,
        ];
    }

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
