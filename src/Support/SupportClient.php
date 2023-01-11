<?php

namespace ArrowSphere\PublicApiClient\Support;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class SupportClient extends AbstractSupportClient
{
    /**
     * @param array $data
     *
     * @return int
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function createIssue(array $data): int
    {
        return $this->getIssueClient()->createIssue($data);
    }

    /**
     * @param array $data
     *
     * @return array|null
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function listIssues(array $data = []): ?array
    {
        return $this->getIssueClient()->listIssues($data);
    }

    /**
     * @param int $issueId
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getIssue(int $issueId): array
    {
        return $this->getIssueClient()->getIssue($issueId);
    }

    /**
     * @param int $issueId
     * @param array $data
     *
     * @return array|null
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function closeIssue(int $issueId, array $data): ?array
    {
        return $this->getIssueClient()->closeIssue($issueId, $data);
    }

    /**
     * @param int $issueId
     * @param array $data
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function addAttachment(int $issueId, array $data): array
    {
        return $this->getAttachmentClient()->addAttachment($issueId, $data);
    }

    /**
     * @param int $issueId
     *
     * @return array|null
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function listAttachments(int $issueId): ?array
    {
        return $this->getAttachmentClient()->listAttachments($issueId);
    }

    /**
     * @param int $issueId
     * @param int $attachmentId
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getAttachment(int $issueId, int $attachmentId): array
    {
        return $this->getAttachmentClient()->getAttachment($issueId, $attachmentId);
    }

    /**
     * @param int $issueId
     * @param array $data
     *
     * @return array|null
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function listComments(int $issueId, array $data = []): ?array
    {
        return $this->getCommentClient()->listComments($issueId, $data);
    }

    /**
     * Make multiple call to /comments to get all the comments attached to a ticket
     *
     * @param int $issueId
     *
     * @return array
     *
     * @throws Exception
     */
    public function listAllComments(int $issueId): array
    {
        return $this->getCommentClient()->listAllComments($issueId);
    }

    /**
     * @param int $issueId
     * @param array $data
     *
     * @return int|null
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function addComment(int $issueId, array $data): ?int
    {
        return $this->getCommentClient()->addComment($issueId, $data);
    }

    /**
     * @return array
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function listTopics(): array
    {
        return $this->getTopicClient()->listTopics();
    }
}
