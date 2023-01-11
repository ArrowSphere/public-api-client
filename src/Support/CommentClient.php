<?php

namespace ArrowSphere\PublicApiClient\Support;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use GuzzleHttp\Exception\GuzzleException;

class CommentClient extends SupportClient
{
    private const COMMENTS_PATH_NAME = '/comments';

    public function __construct()
    {
        parent::__construct();

        $this->basePath .= '/issues/';
    }

    /**
     * @inheritdoc
     */
    public function listComments(int $issueId, array $data = []): ?array
    {
        $response = $this->listCommentsWithPagination($issueId, $data);

        return $this->getResponseData($response);
    }

    /**
     * @param int $issueId
     * @param array $data
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    private function listCommentsWithPagination(int $issueId, array $data = []): string
    {
        $this->path = $issueId . self::COMMENTS_PATH_NAME;

        return $this->get($data);
    }

    /**
     * @inheritdoc
     */
    public function listAllComments(int $issueId): array
    {
        $data = [];
        $result = [];
        //$pagination['current_page'] is Bugged in the API, so I'm doing it manually
        $currentPage = 1;
        do {
            $response = $this->listCommentsWithPagination($issueId, $data);
            $pagination = $this->getPagination($response);
            $result = [$result, $this->getResponseData($response)];
            if (empty($pagination['next'])) {
                break;
            }
            $url = is_string(parse_url($pagination['next'], PHP_URL_QUERY)) ? parse_url($pagination['next'], PHP_URL_QUERY) : '';
            parse_str($url, $data);
            $currentPage++;
        } while ($currentPage <= $pagination['total_page']);

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function addComment(int $issueId, array $data): ?int
    {
        $this->path = $issueId . self::COMMENTS_PATH_NAME;
        $response = $this->post($data);
        $result = $this->getResponseData($response);

        return $result['id'];
    }
}
