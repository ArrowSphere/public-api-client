<?php

namespace ArrowSphere\PublicApiClient\Reports;

use ArrowSphere\PublicApiClient\AbstractClient;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Reports\Entities\ValidateReportResult;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class ReportsClient
 */
class ReportsClient extends AbstractClient
{
    /**
     * @var string The base path for reports endpoints
     */
    protected $basePath = '/reports';

    /**
     * Validates a report and returns the raw JSON response.
     *
     * @param string $reportReference
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function validateReportRaw(string $reportReference): string
    {
        $this->path = '/' . urlencode($reportReference);

        return $this->patch([])->__toString();
    }

    /**
     * Validates a report and returns the result entity.
     *
     * @param string $reportReference
     *
     * @return ValidateReportResult
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function validateReport(string $reportReference): ValidateReportResult
    {
        $rawResponse = $this->validateReportRaw($reportReference);
        $response = $this->getResponseData($rawResponse);

        return new ValidateReportResult($response);
    }
}
