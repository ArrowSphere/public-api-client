<?php

namespace ArrowSphere\PublicApiClient\Campaigns\Entities\Asset;

use ArrowSphere\PublicApiClient\AbstractEntity;

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
    private $key;

    /**
     * @var string
     */
    private $bucket;

    /**
     * @var string
     */
    private $amzAlgorithm;

    /**
     * @var string
     */
    private $amzCredential;

    /**
     * @var string
     */
    private $amzDate;

    /**
     * @var string
     */
    private $amzSecurityToken;

    /**
     * @var string
     */
    private $policy;

    /**
     * @var string
     */
    private $amzSignature;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->key = $data[self::COLUMN_KEY];
        $this->bucket = $data[self::COLUMN_BUCKET];
        $this->amzAlgorithm = $data[self::COLUMN_X_AMZ_ALGORITHM];
        $this->amzCredential = $data[self::COLUMN_X_AMZ_CREDENTIAL];
        $this->amzDate = $data[self::COLUMN_X_AMZ_DATE];
        $this->amzSecurityToken = $data[self::COLUMN_X_AMZ_SECURITY_TOKEN];
        $this->policy = $data[self::COLUMN_POLICY];
        $this->amzSignature = $data[self::COLUMN_X_AMZ_SIGNATURE];
    }

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

    public function jsonSerialize(): array
    {
        return [
            self::COLUMN_KEY                  => $this->key,
            self::COLUMN_BUCKET               => $this->bucket,
            self::COLUMN_X_AMZ_ALGORITHM      => $this->amzAlgorithm,
            self::COLUMN_X_AMZ_CREDENTIAL     => $this->amzCredential,
            self::COLUMN_X_AMZ_DATE           => $this->amzDate,
            self::COLUMN_X_AMZ_SECURITY_TOKEN => $this->amzSecurityToken,
            self::COLUMN_POLICY               => $this->policy,
            self::COLUMN_X_AMZ_SIGNATURE      => $this->amzSignature,
        ];
    }
}
