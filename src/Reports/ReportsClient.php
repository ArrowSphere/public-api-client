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
     * @param string|null $customerPoNumber The customer PO number to set on the generated order
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function validateReportRaw(string $reportReference, ?string $customerPoNumber = null): string
    {
        $this->path = '/' . urlencode($reportReference);

        $payload = [];
        if ($customerPoNumber !== null) {
            $payload['customerPoNumber'] = $customerPoNumber;
        }

        return $this->patch($payload)->__toString();
    }

    /**
     * Validates a report and returns the result entity.
     *
     * @param string $reportReference
     * @param string|null $customerPoNumber The customer PO number to set on the generated order
     *
     * @return ValidateReportResult
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws \ArrowSphere\PublicApiClient\Entities\Exception\EntitiesException
     */
    public function validateReport(string $reportReference, ?string $customerPoNumber = null): ValidateReportResult
    {
        $rawResponse = $this->validateReportRaw($reportReference, $customerPoNumber);
        $response = $this->getResponseData($rawResponse);

        return new ValidateReportResult($response);
    }
}
