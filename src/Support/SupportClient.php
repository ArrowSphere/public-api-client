<?php

namespace ArrowSphere\PublicApiClient\Support;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class SupportClient extends AbstractClient
{
    /**
     * @var string The base path of the Support API
     */
    private const ROOT_PATH = '/support';

    /**
     * @var string The base path of the API
     */
    protected $basePath = self::ROOT_PATH;

    /**
     * @param array $data
     * @param array $parameters
     *
     * @return int
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function createIssue(array $data, array $parameters = []): int
    {
        $this->path = '/issues';
        $response = $this->post($data, $parameters);
        $result = $this->getResponseData($response->__toString());

        return $result['id'];
    }

    /**
     * @param array $parameters
     *
     * @return array|null
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function listIssues(array $parameters = []): ?array
    {
        $this->path = '/issues';
        $response = $this->get($parameters);

        return $this->getResponseData($response);
    }

    /**
     * @param int $issueId
     * @param array $parameters
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getIssue(int $issueId, array $parameters = []): array
    {
        $this->path = sprintf('/issues/%d', $issueId);
        $response = $this->get($parameters);

        return $this->getResponseData($response);
    }

    /**
     * @param int $issueId
     * @param array $data
     * @param array $parameters
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function closeIssue(int $issueId, array $data, array $parameters = []): void
    {
        $this->path = sprintf('/issues/%d', $issueId);

        $this->patch($data, $parameters);
    }

    /**
     * @param int $issueId
     * @param array $data
     * @param array $parameters
     *
     * @return int
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function addAttachment(int $issueId, array $data, array $parameters = []): int
    {
        $this->path = sprintf('/issues/%d/attachments', $issueId);
        $response = $this->post($data, $parameters);

        $result = $this->getResponseData($response->__toString());

        return $result['id'];
    }

    /**
     * @param int $issueId
     * @param array $parameters
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function listAttachments(int $issueId, array $parameters = []): array
    {
        $this->path = sprintf('/issues/%d/attachments', $issueId);
        $response = $this->get($parameters);

        return $this->getResponseData($response);
    }

    /**
     * @param int $issueId
     * @param int $attachmentId
     * @param array $parameters
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getAttachment(int $issueId, int $attachmentId, array $parameters = []): array
    {
        $this->path = sprintf('/issues/%d/attachments/%d', $issueId, $attachmentId);
        $response = $this->get($parameters);

        return $this->getResponseData($response);
    }

    /**
     * @param int $issueId
     * @param array $parameters
     *
     * @return array|null
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function listComments(int $issueId, array $parameters = []): ?array
    {
        $response = $this->listCommentsWithPagination($issueId, $parameters);

        return $this->getResponseData($response);
    }

    /**
     * @param int $issueId
     * @param array $parameters
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    private function listCommentsWithPagination(int $issueId, array $parameters = []): string
    {
        $this->path = sprintf('/issues/%d/comments', $issueId);

        return $this->get($parameters);
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
        $data = [];
        $result = [];
        $currentPage = 1;

        do {
            $response = $this->listCommentsWithPagination($issueId, $data);
            $pagination = $this->getPagination($response);
            $result[] = $this->getResponseData($response);

            if (! isset($pagination['next'])) {
                break;
            }

            $url = is_string(parse_url($pagination['next'], PHP_URL_QUERY)) ? parse_url($pagination['next'], PHP_URL_QUERY) : '';
            parse_str($url, $data);
            $currentPage++;
        } while ($currentPage <= $pagination['total_page']);

        return array_merge(...$result);
    }

    /**
     * @param int $issueId
     * @param array $data
     * @param array $parameters
     *
     * @return int|null
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function addComment(int $issueId, array $data, array $parameters = []): ?int
    {
        $this->path = sprintf('/issues/%d/comments', $issueId);
        $response = $this->post($data, $parameters);
        $result = $this->getResponseData($response->__toString());

        return $result['id'];
    }

    /**
     * @param array $parameters
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function listTopics(array $parameters = []): array
    {
        $this->path = '/topics';

        $response = $this->get($parameters);

        return $this->getResponseData($response);
    }
}
