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
     * @var string reportPeriod index
     */
    public const REPORT_PERIOD = 'reportPeriod';

    /**
     * @var string customerName index
     */
    public const CUSTOMER_NAME = 'customerName';

    /**
     * @var string customerXspRef index
     */
    public const CUSTOMER_XSP_REF = 'customerXspRef';

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
     * @var string tier index
     */
    public const TIER = 'tier';

    /**
     * @var string format index
     */
    public const FORMAT = 'format';

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
     * @param string[] $reportPeriod YYYY-MM
     * @param string $customerName
     * @param string $currency
     * @param string $buyTotal
     * @param string $sellTotal
     * @param string $issueDate
     *
     * @return Generator|Statement[]
     *
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws ReflectionException
     */
    public function getStatements(array $reportPeriod = [], string $customerName = '', string $currency = '', string $buyTotal = '', string $sellTotal = '', string $issueDate = ''): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);

            $rawResponse = $this->getStatementsRaw($reportPeriod, $customerName, $currency, $buyTotal, $sellTotal, $issueDate);
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
     * @param string[] $reportPeriod YYYY-MM
     * @param string $customerName
     * @param string $currency
     * @param string $buyTotal
     * @param string $sellTotal
     * @param string $issueDate
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getStatementsRaw(array $reportPeriod = [], string $customerName = '', string $currency = '', string $buyTotal = '', string $sellTotal = '', string $issueDate = ''): string
    {
        $this->path = '/statements';
        $parameters = [
            self::REPORT_PERIOD => $reportPeriod,
            self::CUSTOMER_NAME => $customerName,
            self::CURRENCY      => $currency,
            self::BUY_TOTAL     => $buyTotal,
            self::SELL_TOTAL    => $sellTotal,
            self::ISSUE_DATE    => $issueDate,
        ];

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
        $this->setPerPage(100);
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
     * @param string[] $reportPeriod YYYY-MM
     * @param string[] $customerName
     * @param string[] $customerXspRef
     * @param string $currency
     * @param string $buyTotal
     * @param string $sellTotal
     * @param string $issueDateFrom
     * @param string $issueDateTo
     * @param int[] $tier
     * @param string $format
     *
     * @return void
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function createExport(array $reportPeriod = [], array $customerName = [], array $customerXspRef = [], string $currency = '', string $buyTotal = '', string $sellTotal = '', string $issueDateFrom = '', string $issueDateTo = '', array $tier = [TierEnum::RESELLER, TierEnum::END_CUSTOMER], string $format = 'xlsx'): void
    {
        if (count($tier) === 0 && count($tier) !== count(array_filter($tier, [TierEnum::class, 'isValidValue']))) {
            throw new PublicApiClientException('Error: Invalid tier value', 400);
        }
        if (! FormatEnum::isValidValue($format)) {
            throw new PublicApiClientException('Error: Invalid format value', 400);
        }

        $this->path = '/exports';
        $parameters = [
            self::REPORT_PERIOD    => $reportPeriod,
            self::CUSTOMER_NAME    => $customerName,
            self::CUSTOMER_XSP_REF => $customerXspRef,
            self::CURRENCY         => $currency,
            self::BUY_TOTAL        => $buyTotal,
            self::SELL_TOTAL       => $sellTotal,
            self::ISSUE_DATE_FROM  => $issueDateFrom,
            self::ISSUE_DATE_TO    => $issueDateTo,
            self::TIER             => $tier,
            self::FORMAT           => $format,
        ];

        $this->post(array_filter($parameters, static function ($val) {
            return $val !== '' && $val !== [];
        }));
    }
}
