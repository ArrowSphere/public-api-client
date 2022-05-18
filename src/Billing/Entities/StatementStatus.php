<?php

namespace ArrowSphere\PublicApiClient\Billing\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Billing\Enum\StatementStatusEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

class StatementStatus extends AbstractEntity
{
    public const COLUMN_CREATION_DATE = 'creationDate';
    public const COLUMN_SUBMISSION_DATE = 'submissionDate';
    public const COLUMN_VALIDATION_DATE = 'validationDate';
    public const COLUMN_REJECTION_DATE = 'rejectionDate';
    public const COLUMN_STATE = 'state';

    protected const VALIDATION_RULES = parent::VALIDATION_RULES + [
        self::COLUMN_CREATION_DATE => 'string|present|nullable',
        self::COLUMN_SUBMISSION_DATE => 'string|present|nullable',
        self::COLUMN_VALIDATION_DATE => 'string|present|nullable',
        self::COLUMN_REJECTION_DATE => 'string|present|nullable',
        self::COLUMN_STATE => 'string|required',
    ];

    /**
     * @var string|null
     */
    private $creationDate;

    /**
     * @var string|null
     */
    private $submissionDate;

    /**
     * @var string|null
     */
    private $validationDate;

    /**
     * @var string|null
     */
    private $rejectionDate;

    /**
     * @var string
     */
    private $state;

    /**
     * Status constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     * @throws \ReflectionException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        if (self::$enableValidation && ! StatementStatusEnum::isValidValue($data[self::COLUMN_STATE])) {
            throw new EntityValidationException('Billing Statement State: ' . $data[self::COLUMN_STATE] . ' not supported');
        }

        $this->creationDate = $data[self::COLUMN_CREATION_DATE];
        $this->submissionDate = $data[self::COLUMN_SUBMISSION_DATE];
        $this->validationDate = $data[self::COLUMN_VALIDATION_DATE];
        $this->rejectionDate = $data[self::COLUMN_REJECTION_DATE];
        $this->state = $data[self::COLUMN_STATE];
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_CREATION_DATE => $this->getCreationDate(),
            self::COLUMN_SUBMISSION_DATE => $this->getSubmissionDate(),
            self::COLUMN_VALIDATION_DATE => $this->getValidationDate(),
            self::COLUMN_REJECTION_DATE => $this->getRejectionDate(),
            self::COLUMN_STATE => $this->getState(),
        ];
    }
}
