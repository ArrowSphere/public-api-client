<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class Gdap
 */
class Gdap extends AbstractEntity
{
    public const COLUMN_ID = 'id';

    public const COLUMN_DISPLAY_NAME = 'displayName';

    public const COLUMN_STATUS = 'status';

    public const COLUMN_START_DATE = 'startDate';

    public const COLUMN_END_DATE = 'endDate';

    public const COLUMN_DURATION = 'duration';

    public const COLUMN_DURATION_IN_DAYS = 'durationInDays';

    public const COLUMN_AUTO_EXTEND = 'autoExtend';

    public const COLUMN_APPROVAL_LINK = 'approvalLink';

    public const COLUMN_PRIVILEGES = 'privileges';

    public const COLUMN_SECURITY_GROUPS = 'securityGroups';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_ID)]
    protected string $id = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DISPLAY_NAME)]
    protected string $displayName = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_STATUS)]
    protected string $status = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_START_DATE)]
    protected string $startDate = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_END_DATE)]
    protected string $endDate = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DURATION)]
    protected string $duration = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_DURATION_IN_DAYS)]
    protected string $durationInDays = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_AUTO_EXTEND)]
    protected string $autoExtend = '';

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_APPROVAL_LINK)]
    protected string $approvalLink = '';

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_PRIVILEGES, type: 'array')]
    protected array $privileges = [];

    /**
     * @var array
     */
    #[Property(name: self::COLUMN_SECURITY_GROUPS, type: 'array')]
    protected array $securityGroups = [];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getDuration(): string
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getDurationInDays(): string
    {
        return $this->durationInDays;
    }

    /**
     * @return string
     */
    public function getAutoExtend(): string
    {
        return $this->autoExtend;
    }

    /**
     * @return string
     */
    public function getApprovalLink(): string
    {
        return $this->approvalLink;
    }

    /**
     * @return array
     */
    public function getPrivileges(): array
    {
        return $this->privileges;
    }

    /**
     * @return array
     */
    public function getSecurityGroups(): array
    {
        return $this->securityGroups;
    }
}
