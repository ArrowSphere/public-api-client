<?php

namespace ArrowSphere\PublicApiClient\Tests\Monitoring;

use ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Monitoring\MonitoringClient;
use ArrowSphere\PublicApiClient\Monitoring\Request\Report;
use ArrowSphere\PublicApiClient\Tests\AbstractClientTest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use JsonException;

/**
 * Class CustomersClientTest
 *
 * @property MonitoringClient $client
 */
class MonitoringClientTest extends AbstractClientTest
{
    protected const MOCKED_CLIENT_CLASS = MonitoringClient::class;

    /**
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws PublicApiClientException
     * @throws JsonException
     * @throws EntitiesException
     */
    public function testReport(): void
    {

        $report = new Report(
            [
            'body'     => ['test'],
            'url'      => 'https://www.test.com',
            'type'     => 'test',
            'userAgent' => 'test'
            ]
        ) ;
        $this->httpClient
            ->expects(self::once())
            ->method('request')
            ->with(
                'post',
                'https://www.test.com/monitoring/report',
                [
                    'headers' => [
                        'apiKey'       => '123456',
                        'Content-Type' => 'application/json',
                        'User-Agent'   => $this->userAgentHeader,
                    ],
                    'body'    => json_encode([$report->jsonSerialize()], JSON_THROW_ON_ERROR),
                ]
            )
            ->willReturn(new Response(204, [], 'OK'));

        $res = $this->client->sendReport([$report]);
        self::assertTrue($res);
    }
}
