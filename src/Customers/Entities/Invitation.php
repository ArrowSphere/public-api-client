<?php

namespace ArrowSphere\PublicApiClient\Customers\Entities;

use ArrowSphere\PublicApiClient\Customers\Entities\Invitation\Company as InvitationCompany;
use ArrowSphere\PublicApiClient\Customers\Entities\Invitation\Contact as InvitationContact;
use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

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
    #[Property(name: self::COLUMN_CODE, required: true)]
    protected string $code;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_CREATED_AT, required: true)]
    protected string $createdAt;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_UPDATED_AT, required: true)]
    protected string $updatedAt;

    /**
     * @var InvitationContact
     */
    #[Property(name: self::COLUMN_CONTACT, type: InvitationContact::class, required: true)]
    protected InvitationContact $contact;

    /**
     * @var InvitationCompany
     */
    #[Property(name: self::COLUMN_COMPANY, type: InvitationCompany::class, required: true)]
    protected InvitationCompany $company;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_POLICY, required: true)]
    protected string $policy;

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
}
