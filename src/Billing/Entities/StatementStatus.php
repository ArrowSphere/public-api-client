<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity as LegacyAbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\StatementStatusEnum;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Entities\Property;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class StatementStatus extends AbstractEntity
{
    public const COLUMN_CREATION_DATE = 'creationDate';
    public const COLUMN_SUBMISSION_DATE = 'submissionDate';
    public const COLUMN_VALIDATION_DATE = 'validationDate';
    public const COLUMN_REJECTION_DATE = 'rejectionDate';
    public const COLUMN_STATE = 'state';

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_CREATION_DATE, serializeNull: true)]
    protected ?string $creationDate = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_SUBMISSION_DATE, serializeNull: true)]
    protected ?string $submissionDate = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_VALIDATION_DATE, serializeNull: true)]
    protected ?string $validationDate = null;

    /**
     * @var string|null
     */
    #[Property(name: self::COLUMN_REJECTION_DATE, serializeNull: true)]
    protected ?string $rejectionDate = null;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_STATE, required: true)]
    protected string $state;

    /**
     * StatementStatus constructor.
     *
     * @param array $data
     *
     * @throws EntitiesException
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (LegacyAbstractEntity::$enableValidation && ! StatementStatusEnum::isValidValue($this->state)) {
            throw new EntityValidationException('Billing Statement State: ' . $this->state . ' not supported');
        }
    }

    /**
     * @return string|null
     */
    public function getCreationDate(): ?string
    {
        return $this->creationDate;
    }

    /**
     * @return string|null
     */
    public function getSubmissionDate(): ?string
    {
        return $this->submissionDate;
    }

    /**
     * @return string|null
     */
    public function getValidationDate(): ?string
    {
        return $this->validationDate;
    }

    /**
     * @return string|null
     */
    public function getRejectionDate(): ?string
    {
        return $this->rejectionDate;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }
}
