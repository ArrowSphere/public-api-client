<?php

namespace ArrowSphere\PublicApiClient\Support;

use ArrowSphere\PublicApiClient\AbstractClient;

/**
 * Class AbstractSupportClient for interacting with the Support and it subCategory endpoints
 */
abstract class AbstractSupportClient extends AbstractClient
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
     * @var IssueClient|null
     */
    private $issueClient;

    /**
     * @var CommentClient|null
     */
    private $commentClient;

    /**
     * @var AttachmentClient|null
     */
    private $attachmentClient;

    /**
     * @var TopicClient|null
     */
    private $topicClient;

    /**
     * @return IssueClient
     */
    public function getIssueClient(): IssueClient
    {
        if ($this->issueClient === null) {
            $this->issueClient = (new IssueClient())
                ->setUrl($this->url)
                ->setApiKey($this->apiKey)
                ->setDefaultHeaders($this->defaultHeaders);
        }

        return $this->issueClient;
    }

    /**
     * @return CommentClient
     */
    public function getCommentClient(): CommentClient
    {
        if ($this->commentClient === null) {
            $this->commentClient = (new CommentClient())
                ->setUrl($this->url)
                ->setApiKey($this->apiKey)
                ->setDefaultHeaders($this->defaultHeaders);
        }

        return $this->commentClient;
    }

    /**
     * @return AttachmentClient
     */
    public function getAttachmentClient(): AttachmentClient
    {
        if ($this->attachmentClient === null) {
            $this->attachmentClient = (new AttachmentClient())
                ->setUrl($this->url)
                ->setApiKey($this->apiKey)
                ->setDefaultHeaders($this->defaultHeaders);
        }

        return $this->attachmentClient;
    }

    /**
     * @return TopicClient
     */
    public function getTopicClient(): TopicClient
    {
        if ($this->topicClient === null) {
            $this->topicClient = (new TopicClient())
                ->setUrl($this->url)
                ->setApiKey($this->apiKey)
                ->setDefaultHeaders($this->defaultHeaders);
        }

        return $this->topicClient;
    }
}
