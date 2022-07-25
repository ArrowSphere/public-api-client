<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Customers\Entities\Invitation\Company as InvitationCompany;
use ArrowSphere\PublicApiClient\Customers\Entities\Invitation\Contact as InvitationContact;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;

/**
 * Class Invitation
 */
class Invitation extends AbstractEntity
{
    public const COLUMN_CODE = 'code';

    public const COLUMN_CREATED_AT = 'createdAt';

    public const COLUMN_UPDATED_AT = 'updatedAt';

    public const COLUMN_CONTACT = 'contact';

    public const COLUMN_COMPANY = 'company';

    public const COLUMN_POLICY = 'policy';

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @var InvitationContact
     */
    private $contact;

    /**
     * @var InvitationCompany
     */
    private $company;

    /**
     * @var string
     */
    private $policy;

    /**
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->code = $data[self::COLUMN_CODE];
        $this->createdAt = $data[self::COLUMN_CREATED_AT];
        $this->updatedAt = $data[self::COLUMN_UPDATED_AT];
        $this->contact = new InvitationContact($data[self::COLUMN_CONTACT]);
        $this->company = new InvitationCompany($data[self::COLUMN_COMPANY]);
        $this->policy = $data[self::COLUMN_POLICY];
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return static
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     *
     * @return static
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     *
     * @return static
     */
    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return InvitationContact
     */
    public function getContact(): InvitationContact
    {
        return $this->contact;
    }

    /**
     * @param InvitationContact $contact
     *
     * @return static
     */
    public function setContact(InvitationContact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return InvitationCompany
     */
    public function getCompany(): InvitationCompany
    {
        return $this->company;
    }

    /**
     * @param InvitationCompany $company
     *
     * @return static
     */
    public function setCompany(InvitationCompany $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string
     */
    public function getPolicy(): string
    {
        return $this->policy;
    }

    /**
     * @param string $policy
     *
     * @return static
     */
    public function setPolicy(string $policy): self
    {
        $this->policy = $policy;

        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_CODE => $this->code,
            self::COLUMN_CREATED_AT => $this->createdAt,
            self::COLUMN_UPDATED_AT => $this->updatedAt,
            self::COLUMN_CONTACT => $this->contact->jsonSerialize(),
            self::COLUMN_COMPANY => $this->company->jsonSerialize(),
            self::COLUMN_POLICY => $this->policy,
        ];
    }
}
