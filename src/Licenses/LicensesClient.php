<?php

namespace ArrowSphere\PublicApiClient\Licenses;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Licenses\Entities\FindResult;
use ArrowSphere\PublicApiClient\Licenses\Entities\License\Config;
use ArrowSphere\PublicApiClient\Licenses\Entities\License\Predictions;
use Generator;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class LicensesClient
 */
class LicensesClient extends AbstractLicensesClient
{
    /**
     * @var string The path of the Find endpoint
     */
    private const FIND_PATH = '/v2/find';

    /**
     * @var string The path of the Configs endpoint
     */
    private const CONFIGS_PATH = '/configs';

    /**
     * @var string The path of the Predictions endpoint
     */
    private const PREDICTION_PATH = '/predictions/daily';

    /**
     * @var string The key for keyword search query parameter (to search one string in all available search fields)
     */
    public const DATA_KEYWORD = 'keyword';

    /**
     * @var string The key for keywords search query parameter (to search with a complex object)
     */
    public const DATA_KEYWORDS = 'keywords';

    /**
     * @var string The key for compare search query parameter (to search with a complex object)
     */
    public const DATA_COMPARE = 'compare';

    /**
     * @var string The key for filers search query parameter
     */
    public const DATA_FILTERS = 'filters';

    /**
     * @var string The key for exclusion filters search query parameter
     */
    public const DATA_EXCLUSION_FILTERS = 'exclusionFilters';

    /**
     * @var string The key for sort search query parameter
     */
    public const DATA_SORT = 'sort';

    /**
     * @var string The key for highlight search query parameter
     */
    public const DATA_HIGHLIGHT = 'highlight';

    /**
     * @var string Use this constant to sort in ascending direction
     */
    public const SORT_ASCENDING = 'asc';

    /**
     * @var string Use this constant to sort in descending direction
     */
    public const SORT_DESCENDING = 'desc';

    /**
     * @var string The key to search for keywords values
     */
    public const KEYWORDS_VALUES = 'values';

    /**
     * @var string The key to specify the operator to use with the keywords values
     */
    public const KEYWORDS_OPERATOR = 'operator';

    /**
     * @var string The key to specify the operator to use with the compare field
     */
    public const COMPARE_OPERATOR = self::KEYWORDS_OPERATOR;

    /**
     * @var string The key to specify the operator to use with the keywords or compares values
     */
    public const COMPARE_FIELD = 'field';

    /**
     * @var string Use this operator to search for all keywords values specified
     */
    public const OPERATOR_AND = 'AND';

    /**
     * @var string Use this operator to search for any keywords values specified
     */
    public const OPERATOR_OR = 'OR';

    /**
     * @var string Use this operator to search for all keywords with values in the range specified (for date ranges)
     */
    public const OPERATOR_BETWEEN = 'BETWEEN';

    /**
     * @var string Use this operator to search with a compare field Equal
     */
    public const OPERATOR_EQ = 'EQ';

    /**
     * @var string Use this operator to search with a compare field Not Equal
     */
    public const OPERATOR_NEQ = 'NEQ';

    /**
     * @var string Use this operator to search with a compare field Greater Than
     */
    public const OPERATOR_GT = 'GT';

    /**
     * @var string Use this operator to search with a compare field Greater Than or Equal
     */
    public const OPERATOR_GTE = 'GTE';

    /**
     * @var string Use this operator to search with a compare field Lower Than
     */
    public const OPERATOR_LT = 'LT';

    /**
     * @var string Use this operator to search with a compare field Lower Than or Equal
     */
    public const OPERATOR_LTE = 'LTE';

    /**
     * @param array $postData
     * @param array $parameters
     *
     * @return string
     *
     * @throws PublicApiClientException
     * @throws NotFoundException
     * @throws GuzzleException
     */
    public function findRaw(array $postData, array $parameters = []): string
    {
        $this->path = self::FIND_PATH;

        if (isset($postData[self::DATA_KEYWORDS])) {
            foreach ($postData[self::DATA_KEYWORDS] as &$row) {
                $row[self::KEYWORDS_VALUES] = is_array($row[self::KEYWORDS_VALUES]) ? array_values($row[self::KEYWORDS_VALUES]) : $row[self::KEYWORDS_VALUES];
            }
        }

        if (isset($postData[self::DATA_FILTERS])) {
            $postData[self::DATA_FILTERS] = array_map(static function ($row) {
                return is_array($row) ? array_values($row) : $row;
            }, $postData[self::DATA_FILTERS]);
        }

        return $this->post($postData, $parameters, ['Content-Type' => 'application/json']);
    }

    /**
     * @param array $postData
     * @param int $perPage
     * @param int $page
     * @param array $parameters
     *
     * @return FindResult
     *
     * @throws EntityValidationException
     * @throws PublicApiClientException
     * @throws GuzzleException
     */
    public function find(array $postData, int $perPage = 100, int $page = 1, array $parameters = []): FindResult
    {
        $this->setPerPage($perPage);
        $this->setPage($page);

        $rawResponse = $this->findRaw($postData, $parameters);
        $response = $this->decodeResponse($rawResponse);

        return new FindResult($response, $this, $postData, $parameters);
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
    public function getConfigsRaw(string $reference): string
    {
        $this->path = '/' . $reference . self::CONFIGS_PATH;

        return $this->get();
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
    public function getPredictionDailyRaw(string $reference, array $parameters = []): string
    {
        $this->path = '/' . $reference . self::PREDICTION_PATH;

        return $this->get();
    }

    /**
     * @param string $reference
     *
     * @return Predictions
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getPrediction(string $reference): Predictions
    {
        $rawResponse = $this->getPredictionDailyRaw($reference);
        $response = $this->decodeResponse($rawResponse);

        return new Predictions($response['data']);
    }

    /**
     * @param string $reference
     *
     * @return Generator|Config[]
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getConfigs(string $reference): Generator
    {
        $rawResponse = $this->getConfigsRaw($reference);
        $response = $this->decodeResponse($rawResponse);

        foreach ($response['data'] as $data) {
            yield new Config($data);
        }
    }

    /**
     * @param string $reference
     * @param Config $config
     *
     * @return string
     *
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function updateConfigRaw(string $reference, Config $config): string
    {
        $this->path = '/' . $reference . self::CONFIGS_PATH;
        $postData = [
            Config::COLUMN_SCOPE => $config->getScope(),
            Config::COLUMN_NAME => $config->getName(),
            Config::COLUMN_STATE => $config->getState(),
        ];

        return $this->post($postData, [], ['Content-Type' => 'application/json'])->getContents();
    }

    /**
     * @param string $reference
     * @param Config $config
     *
     * @return Config
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function updateConfig(string $reference, Config $config): Config
    {
        $rawResponse = $this->updateConfigRaw($reference, $config);
        $response = $this->decodeResponse($rawResponse);

        return new Config($response['data']);
    }
}
