<?php

namespace ArrowSphere\PublicApiClient\Tests;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\AbstractEntity;
use ArrowSphere\PublicApiClient\Common\ValueObject\UserAgentHeader;
use GuzzleHttp\Client;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractClientTest
 */
abstract class AbstractClientTest extends TestCase
{
    /**
     * @var MockObject|Client
     */
    protected $httpClient;

    /**
     * @var AbstractClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $userAgentHeader;

    protected const MOCKED_CLIENT_CLASS = null;

    /**
     * Initialization of the mocked curler and the API client.
     */
    public function setUp(): void
    {
        // For the tests we want the validation to happen
        AbstractEntity::$enableValidation = true;

        $this->httpClient = $this->createMock(Client::class);

        $class = static::MOCKED_CLIENT_CLASS;

        if ($class === null) {
            self::fail('You should override const MOCKED_CLIENT_CLASS in your class ' . static::class);
        }

        $this->client = new $class($this->httpClient);
        $this->client->setUrl('https://www.test.com');
        $this->client->setApiKey('123456');

        $this->userAgentHeader = (string) new UserAgentHeader();
    }
}
