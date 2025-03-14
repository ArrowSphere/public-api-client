<?php

namespace ArrowSphere\PublicApiClient\Monitoring;

use ArrowSphere\PublicApiClient\AbstractClient;

use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Monitoring\Request\Report;
use GuzzleHttp\Exception\GuzzleException;

class MonitoringClient extends AbstractClient
{
    /**
     * @param Report[] $reports
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function sendReport(array $reports): bool
    {
        $this->path = '/monitoring/report';
        $this->post(array_map(static fn ($report) => $report->jsonSerialize(), $reports));

        return true;
    }
}
