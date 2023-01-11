<?php

namespace ArrowSphere\PublicApiClient\Support;

class AttachmentClient extends SupportClient
{
    private const ATTACHMENTS_PATH_NAME = '/attachments';

    public function __construct()
    {
        parent::__construct();

        $this->basePath .= '/issues/';
    }

    /**
     * @inheritdoc
     */
    public function addAttachment(int $issueId, array $data): array
    {
        $this->path = $issueId . self::ATTACHMENTS_PATH_NAME;
        $response = $this->post($data);

        return $this->getResponseData($response);
    }

    /**
     * @inheritdoc
     */
    public function listAttachments(int $issueId): ?array
    {
        $this->path = $issueId . self::ATTACHMENTS_PATH_NAME;
        $response = $this->get();

        return $this->getResponseData($response);
    }

    /**
     * @inheritdoc
     */
    public function getAttachment(int $issueId, int $attachmentId): array
    {
        $this->path = $issueId . self::ATTACHMENTS_PATH_NAME . "/$attachmentId";
        $response = $this->get();

        return $this->getResponseData($response);
    }
}
