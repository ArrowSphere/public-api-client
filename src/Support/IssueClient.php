<?php

namespace ArrowSphere\PublicApiClient\Support;

class IssueClient extends SupportClient
{
    public function __construct()
    {
        parent::__construct();

        $this->basePath .= '/issues';
    }

    /**
     * @inheritdoc
     */
    public function createIssue(array $data): int
    {
        $this->path = '';
        $response = $this->post($data);
        $result = $this->getResponseData($response);

        return $result['id'];
    }

    /**
     * @inheritdoc
     */
    public function listIssues(array $data = []): ?array
    {
        $this->path = '';
        $response = $this->get($data);

        return $this->getResponseData($response);
    }

    /**
     * @inheritdoc
     */
    public function getIssue(int $issueId): array
    {
        $this->path = '/' . $issueId;
        $response = $this->get();

        return $this->getResponseData($response);
    }

    /**
     * @inheritdoc
     */
    public function closeIssue(int $issueId, array $data): array
    {
        $this->path = '/' . $issueId;
        $response = $this->patch($data);

        return $this->getResponseData($response);
    }
}
