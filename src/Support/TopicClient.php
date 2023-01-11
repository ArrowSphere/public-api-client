<?php

namespace ArrowSphere\PublicApiClient\Support;

class TopicClient extends SupportClient
{
    public function __construct()
    {
        parent::__construct();

        $this->basePath .= '/topics';
    }

    /**
     * @inheritdoc
     */
    public function listTopics(): array
    {
        $response = $this->get();

        return $this->getResponseData($response);
    }
}
