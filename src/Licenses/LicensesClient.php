<?php

namespace ArrowSphere\PublicApiClient\Licenses;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ArrowSphere\PublicApiClient\Licenses\Entities\FindResult;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class LicensesClient
 */
class LicensesClient extends AbstractLicensesClient
{
    /**
     * @var string The path of the Find endpoint
     */
    private const FIND_PATH = '/find';

    /**
     * @var string The key for keyword search query parameter (to search one string in all available search fields)
     */
    public const DATA_KEYWORD = 'keyword';

    /**
     * @var string The key for keywords search query parameter (to search with a complex object)
     */
    public const DATA_KEYWORDS = 'keywords';

    /**
     * @var string The key for filers search query parameter
     */
    public const DATA_FILTERS = 'filters';

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
     */
    public function find(array $postData, int $perPage = 100, int $page = 1, array $parameters = []): FindResult
    {
        $this->setPerPage($perPage);
        $this->setPage($page);

        $rawResponse = $this->findRaw($postData, $parameters);
        $response = $this->decodeResponse($rawResponse);

        return new FindResult($response, $this, $postData, $parameters);
    }
}
