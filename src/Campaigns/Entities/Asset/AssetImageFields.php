<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\Entities\AbstractEntity;
use ArrowSphere\PublicApiClient\Entities\Property;

/**
 * Class AssetImageFields
 */
class AssetImageFields extends AbstractEntity
{
    public const COLUMN_KEY = "Key";

    public const COLUMN_BUCKET = "bucket";

    public const COLUMN_X_AMZ_ALGORITHM = "X-Amz-Algorithm";

    public const COLUMN_X_AMZ_CREDENTIAL = "X-Amz-Credential";

    public const COLUMN_X_AMZ_DATE = "X-Amz-Date";

    public const COLUMN_X_AMZ_SECURITY_TOKEN = "X-Amz-Security-Token";

    public const COLUMN_POLICY = "Policy";

    public const COLUMN_X_AMZ_SIGNATURE = "X-Amz-Signature";

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_KEY, required: true)]
    protected string $key;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_BUCKET, required: true)]
    protected string $bucket;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_X_AMZ_ALGORITHM, required: true)]
    protected string $amzAlgorithm;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_X_AMZ_CREDENTIAL, required: true)]
    protected string $amzCredential;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_X_AMZ_DATE, required: true)]
    protected string $amzDate;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_X_AMZ_SECURITY_TOKEN, required: true)]
    protected string $amzSecurityToken;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_POLICY, required: true)]
    protected string $policy;

    /**
     * @var string
     */
    #[Property(name: self::COLUMN_X_AMZ_SIGNATURE, required: true)]
    protected string $amzSignature;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getBucket(): string
    {
        return $this->bucket;
    }

    /**
     * @return string
     */
    public function getAmzAlgorithm(): string
    {
        return $this->amzAlgorithm;
    }

    /**
     * @return string
     */
    public function getAmzCredential(): string
    {
        return $this->amzCredential;
    }

    /**
     * @return string
     */
    public function getAmzDate(): string
    {
        return $this->amzDate;
    }

    /**
     * @return string
     */
    public function getAmzSecurityToken(): string
    {
        return $this->amzSecurityToken;
    }

    /**
     * @return string
     */
    public function getPolicy(): string
    {
        return $this->policy;
    }

    /**
     * @return string
     */
    public function getAmzSignature(): string
    {
        return $this->amzSignature;
    }
}
