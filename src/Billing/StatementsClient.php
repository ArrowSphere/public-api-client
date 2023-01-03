<?php

namespace ArrowSphere\PublicApiClient\Billing;

use ArrowSphere\PublicApiClient\Billing\Entities\Statement;
use ArrowSphere\PublicApiClient\Billing\Entities\StatementLine;
use ArrowSphere\PublicApiClient\Billing\Enum\FormatEnum;
use ArrowSphere\PublicApiClient\Billing\Enum\TierEnum;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;
use GuzzleHttp\Exception\GuzzleException;
use ReflectionException;

/**
 * Class StatementsClient
 */
class StatementsClient extends AbstractBillingClient
{
    /**
     * @var string statementRef index
     */
    public const STATEMENT_REF = 'statementRef';

    /**
     * @var string vendorName index
     */
    public const VENDOR_NAME = 'vendorName';

    /**
     * @var string programCode index
     */
    public const PROGRAM_CODE = 'programCode';

    /**
     * @var string classification index
     */
    public const CLASSIFICATION = 'classification';

    /**
     * @var string strategyGroup index
     */
    public const STRATEGY_GROUP = 'strategyGroup';

    /**
     * @var string reportPeriod index
     */
    public const REPORT_PERIOD = 'reportPeriod';

    /**
     * @var string marketplace index
     */
    public const MARKETPLACE = 'marketplace';

    /**
     * @var string issueDate index
     */
    public const ISSUE_DATE = 'issueDate';

    /**
     * @var string issueDateFrom index
     */
    public const ISSUE_DATE_FROM = 'issueDateFrom';

    /**
     * @var string issueDateTo index
     */
    public const ISSUE_DATE_TO = 'issueDateTo';

    /**
     * @var string customerName index
     */
    public const CUSTOMER_NAME = 'customerName';

    /**
     * @var string customerXspRef index
     */
    public const CUSTOMER_XSP_REF = 'customerXspRef';

    /**
     * @var string resellerName index (reserved for internal use)
     */
    public const RESELLER_NAME = 'resellerName';

    /**
     * @var string resellerXspRef index (reserved for internal use)
     */
    public const RESELLER_XSP_REF = 'resellerXspRef';

    /**
     * @var string currency index
     */
    public const CURRENCY = 'currency';

    /**
     * @var string buyTotal index
     */
    public const BUY_TOTAL = 'buyTotal';

    /**
     * @var string sellTotal index
     */
    public const SELL_TOTAL = 'sellTotal';

    /**
     * @var string tier index
     */
    public const TIER = 'tier';

    /**
     * @var string format index
     */
    public const FORMAT = 'format';

    /**
     * @var int per page default value
     */
    private const PER_PAGE_DEFAULT = 1000;

    /**
     * @param string $reference
     *
     * @return Statement|null
     *
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException|ReflectionException
     */
    public function getStatement(string $reference): ?Statement
    {
        $response = $this->getStatementRaw($reference);
        $data = $this->decodeResponse($response);
        $result = null;
        if ($data['data'] && $data['data']['billingStatement']) {
            $result = new Statement($data['data']['billingStatement']);
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
    public function getStatementRaw(string $reference): string
    {
        $reference = urlencode($reference);
        $this->path = "/statements/$reference";

        return $this->get();
    }

    /**
     * Lists the statements.
     * Returns an array (generator) of Statement.
     *
     * @param array $parameters
     *
     * @return Generator|Statement[]
     *
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws ReflectionException
     */
    public function getStatements(array $parameters): Generator
    {
        if (empty($this->perPage)) {
            $this->setPerPage(self::PER_PAGE_DEFAULT);
        }

        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);

            $rawResponse = $this->getStatementsRaw($parameters);
            $response = $this->decodeResponse($rawResponse);

            if (! isset($response['pagination']['totalPages'])) {
                throw new PublicApiClientException(sprintf('Error: Pagination not found in response. Raw response was: "%s"', $rawResponse));
            }

            if ($response['pagination']['totalPages'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            if (! isset($response['data']['billingStatements'])) {
                throw new PublicApiClientException(sprintf('Error: Data not found in response. Raw response was: "%s"', $rawResponse));
            }

            foreach ($response['data']['billingStatements'] as $data) {
                yield new Statement($data);
            }
        }
    }

    /**
     * @param array $parameters Optional parameters to add to the URL
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getStatementsRaw(array $parameters = []): string
    {
        // Parameters should contains string keys
        if (! empty($parameters) && is_numeric(array_keys($parameters)[0])) {
            throw new PublicApiClientException('Error: Invalid parameters value', 400);
        }

        $this->path = '/statements';

        return $this->get(array_filter($parameters, static function ($val) {
            return $val !== '' && $val !== [];
        }));
    }

    /**
     * Lists the lines of a statement.
     * Returns an array (generator) of StatementLine.
     *
     * @param string $statementReference Billing statement reference
     *
     * @return Generator|StatementLine[]
     *
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws ReflectionException
     */
    public function getStatementLines(string $statementReference): Generator
    {
        if (empty($this->perPage)) {
            $this->setPerPage(self::PER_PAGE_DEFAULT);
        }

        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);

            $rawResponse = $this->getStatementLinesRaw($statementReference);
            $response = $this->decodeResponse($rawResponse);

            if (! isset($response['pagination']['totalPages'])) {
                throw new PublicApiClientException(sprintf('Error: Pagination not found in response. Raw response was: "%s"', $rawResponse));
            }

            if ($response['pagination']['totalPages'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            if (! isset($response['data']['billingStatementLines'])) {
                throw new PublicApiClientException(sprintf('Error: Data not found in response. Raw response was: "%s"', $rawResponse));
            }

            foreach ($response['data']['billingStatementLines'] as $data) {
                yield new StatementLine($data);
            }
        }
    }

    /**
     * @param string $statementReference Billing statement reference
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getStatementLinesRaw(string $statementReference): string
    {
        $statementReference = urlencode($statementReference);

        $this->path = "/statements/$statementReference/lines";

        return $this->get();
    }

    /**
     * @param array $parameters Optional parameters to add to the URL
     * @param int[] $tier
     * @param string $format
     *
     * @return string requestRef
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function createExport(array $parameters = [], array $tier = [TierEnum::RESELLER, TierEnum::END_CUSTOMER], string $format = 'xlsx'): string
    {
        // Parameters should contains string keys
        if (! empty($parameters) && is_numeric(array_keys($parameters)[0])) {
            throw new PublicApiClientException('Error: Invalid parameters value', 400);
        }
        if (count($tier) === 0 || count($tier) !== count(array_filter($tier, [TierEnum::class, 'isValidValue']))) {
            throw new PublicApiClientException('Error: Invalid tier value', 400);
        }
        if (! FormatEnum::isValidValue($format)) {
            throw new PublicApiClientException('Error: Invalid format value', 400);
        }

        $this->path = '/exports';

        $parameters[self::TIER] = $tier;
        $parameters[self::FORMAT] = $format;

        $rawResponse = (string)$this->post(array_filter($parameters, static function ($val) {
            return $val !== '' && $val !== [];
        }));

        $response = $this->decodeResponse($rawResponse);

        return $response['data']['requestRef'];
    }
}
