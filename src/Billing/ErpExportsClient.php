<?php

namespace ArrowSphere\PublicApiClient\Billing;

use ArrowSphere\PublicApiClient\Billing\Entities\ErpExportType;
use ArrowSphere\PublicApiClient\Billing\Enum\FormatDateEnum;
use ArrowSphere\PublicApiClient\Billing\Enum\FormatEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;
use GuzzleHttp\Exception\GuzzleException;
use ReflectionException;

/**
 * Class ErpExportsClient
 */
class ErpExportsClient extends AbstractBillingClient
{
    /**
     * @var string type name index
     */
    public const TYPE_NAME = 'name';

    /**
     * @var string type columns index
     */
    public const TYPE_COLUMNS = 'columns';

    /**
     * @var string export type refrence index
     */
    public const EXPORT_TYPE_REFERENCE = 'exportTypeReference';

    /**
     * @var string export output format index
     */
    public const EXPORT_OUTPUT_FORMAT = 'outputFormat';

    /**
     * @var string export output format date index
     */
    public const EXPORT_OUTPUT_FORMAT_DATE = 'date';

    /**
     * @var string export output format file index
     */
    public const EXPORT_OUTPUT_FORMAT_FILE = 'file';

    /**
     * @var string export filters index
     */
    public const EXPORT_FILTERS = 'filters';

    /**
     * @var string export filters issueDate index
     */
    public const EXPORT_FILTERS_ISSUE_DATE = 'issueDate';

    /**
     * @var string export filters validationDate index
     */
    public const EXPORT_FILTERS_VALIDATION_DATE = 'validationDate';

    /**
     * @var string export filters subscriptionDate index
     */
    public const EXPORT_FILTERS_SUBSCRIPTION_DATE = 'subscriptionDate';

    /**
     * @var string export filters createdAt index
     */
    public const EXPORT_FILTERS_CREATED_AT = 'createdAt';

    /**
     * @var string export filters reportPeriod index
     */
    public const EXPORT_FILTERS_REPORT_PERIOD = 'reportPeriod';

    /**
     * @var string export filters classifications index
     */
    public const EXPORT_FILTERS_CLASSIFICATIONS = 'classifications';

    /**
     * @var string export filters vendors index
     */
    public const EXPORT_FILTERS_VENDORS = 'vendors';

    /**
     * @var string export filters programs index
     */
    public const EXPORT_FILTERS_PROGRAMS = 'programs';

    /**
     * @var string export filters marketplaces index
     */
    public const EXPORT_FILTERS_MARKETPLACES = 'marketplaces';

    /**
     * @var string export filters sequences index
     */
    public const EXPORT_FILTERS_SEQUENCES = 'sequences';

    /**
     * @var string export filters references index
     */
    public const EXPORT_FILTERS_REFRENCES = 'references';

    /**
     * @var string export filters resellerXspRefs index
     */
    public const EXPORT_FILTERS_RESELLER_XSP_REFS = 'resellerXspRefs';

    /**
     * @var string export filters resellerCompanyTags index
     */
    public const EXPORT_FILTERS_RESELLER_COMPANY_TAGS = 'resellerCompanyTags';

    /**
     * @var string export filters customerXspRefs index
     */
    public const EXPORT_FILTERS_CUSTOMER_XSP_REFS = 'customerXspRefs';

    /**
     * @var string export filters vendorSubscriptionIds index
     */
    public const EXPORT_FILTERS_VENDOR_SUBSCRIPTION_IDS = 'vendorSubscriptionIds';

    /**
     * @var string export filters friendlyNames index
     */
    public const EXPORT_FILTERS_FRIENDLY_NAMES = 'friendlyNames';

    /**
     * @var string export filters arrowSku index
     */
    public const EXPORT_FILTERS_ARROW_SKU = 'arrowSku';

    /**
     * @var string export filters date from index
     */
    public const EXPORT_FILTERS_DATE_FROM = 'from';

    /**
     * @var string export filters date to index
     */
    public const EXPORT_FILTERS_DATE_TO = 'to';

    /**
     * @return array|null
     *
     * @throws NotFoundException
     * @throws PublicApiClientException|ReflectionException
     */
    public function getErpExportsColumns(): ?array
    {
        $response = $this->getErpExportsColumnsRaw();
        $data = $this->decodeResponse($response);
        $result = null;
        if ($data['data'] && $data['data']['columns']) {
            $result = $data['data']['columns'];
        }

        return $result;
    }

    /**
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getErpExportsColumnsRaw(): string
    {
        $this->path = "/erp/exports/columns";

        return $this->get();
    }

    /**
     * @return array|null
     *
     * @throws NotFoundException
     * @throws PublicApiClientException|ReflectionException
     */
    public function getErpExportsTypes(): ?array
    {
        $response = $this->getErpExportsTypesRaw();
        $data = $this->decodeResponse($response);
        $result = null;
        if ($data['data'] && $data['data']['exportTypes']) {
            $result = $data['data']['exportTypes'];
        }

        return $result;
    }

    /**
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getErpExportsTypesRaw(): string
    {
        $this->path = "/erp/exports/types";

        return $this->get();
    }

    /**
     * @param string $reference
     *
     * @return ErpExportType|null
     *
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException|ReflectionException
     */
    public function getErpExportsType(string $reference): ?ErpExportType
    {
        $response = $this->getErpExportsTypeRaw($reference);
        $data = $this->decodeResponse($response);
        $result = null;
        if ($data['data']) {
            $result = new ErpExportType($data['data']);
        }

        return $result;
    }

    /**
     * @param string $reference
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getErpExportsTypeRaw(string $reference): string
    {
        $reference = urlencode($reference);
        $this->path = "/erp/exports/types/$reference";

        return $this->get();
    }

    /**
     * @param array $parameters parameters to create or update ErpExportsType
     *
     * @return string reference
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function createErpExportsType(array $parameters = []): string
    {
        // Parameters should contains string keys
        if (! empty($parameters) && is_numeric(array_keys($parameters)[0])) {
            throw new PublicApiClientException('Error: Invalid parameters value', 400);
        }
        if (! array_key_exists(self::TYPE_NAME, $parameters)) {
            throw new PublicApiClientException('Error: name parameter not found', 400);
        }
        if (! array_key_exists(self::TYPE_COLUMNS, $parameters)) {
            throw new PublicApiClientException('Error: columns parameter not found', 400);
        }
        $payload = json_encode(array_filter($parameters, static function ($val) {
            return $val !== '' && $val !== [];
        }));
        if (! $payload) {
            throw new PublicApiClientException('Error: Bad request', 400);
        }
        $this->path = '/erp/exports/types';

        $rawResponse = (string)$this->put($payload);

        $response = $this->decodeResponse($rawResponse);

        return $response['data']['reference'];
    }

    /**
     * @param string $reference
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function deleteErpExportsType(string $reference): string
    {
        $reference = urlencode($reference);
        $this->path = "/erp/exports/types/$reference";

        return $this->delete();
    }

    /**
     * @param array $parameters
     *
     * @return string requestRef
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function createErpExportsAsync(array $parameters = []): string
    {
        // Parameters should contains string keys
        if (! empty($parameters) && is_numeric(array_keys($parameters)[0])) {
            throw new PublicApiClientException('Error: Invalid parameters value', 400);
        }
        if (empty(array_filter([$parameters[self::EXPORT_OUTPUT_FORMAT][self::EXPORT_OUTPUT_FORMAT_DATE]], [FormatDateEnum::class, 'isValidValue']))) {
            throw new PublicApiClientException('Error: Invalid output format date value', 400);
        }
        if (empty(array_filter([$parameters[self::EXPORT_OUTPUT_FORMAT][self::EXPORT_OUTPUT_FORMAT_FILE]], [FormatEnum::class, 'isValidValue']))) {
            throw new PublicApiClientException('Error: Invalid output format file value', 400);
        }

        $this->path = '/erp/exports/async';

        $rawResponse = (string)$this->post(array_filter($parameters, static function ($val) {
            return $val !== '' && $val !== [];
        }));

        $response = $this->decodeResponse($rawResponse);

        return $response['data']['requestRef'];
    }

    /**
     * @param array $parameters
     *
     * @return Generator
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function createErpExportSync(array $parameters = []): Generator
    {
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);

            $rawResponse = $this->createErpExportSyncRaw($parameters);
            $response = $this->decodeResponse($rawResponse);

            if (! isset($response['pagination']['perPage'])) {
                throw new PublicApiClientException(sprintf('Error: Pagination not found in response. Raw response was: "%s"', $rawResponse));
            }

            if ($response['pagination']['perPage'] < count($response['data']['values'])) {
                $lastPage = true;
            }

            $currentPage++;

            if (! isset($response['data']['values']) || ! isset($response['data']['headers'])) {
                throw new PublicApiClientException(sprintf('Error: Data not found in response. Raw response was: "%s"', $rawResponse));
            }

            foreach ($response['data']['values'] as $values) {
                yield array_combine($response['data']['headers'], $values);
            }
        }
    }

    /**
    * @param array $parameters
    *
    * @return string
    *
    * @throws NotFoundException
    * @throws PublicApiClientException
    */
    public function createErpExportSyncRaw(array $parameters = []): string
    {
        // Parameters should contains string keys
        if (! empty($parameters) && is_numeric(array_keys($parameters)[0])) {
            throw new PublicApiClientException('Error: Invalid parameters value', 400);
        }
        if (isset($parameters[self::EXPORT_OUTPUT_FORMAT][self::EXPORT_OUTPUT_FORMAT_DATE]) && empty(array_filter([$parameters[self::EXPORT_OUTPUT_FORMAT][self::EXPORT_OUTPUT_FORMAT_DATE]], [FormatDateEnum::class, 'isValidValue']))) {
            throw new PublicApiClientException('Error: Invalid output format date value', 400);
        }

        $this->path = '/erp/exports/sync';

        return (string)$this->post(array_filter($parameters, static function ($val) {
            return $val !== '' && $val !== [];
        }));
    }
}
