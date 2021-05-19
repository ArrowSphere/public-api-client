<?php

namespace ArrowSphere\PublicApiClient\Billing;

use ArrowSphere\PublicApiClient\Billing\Entities\Statement;
use ArrowSphere\PublicApiClient\Billing\Entities\StatementLine;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class StatementsClient
 */
class StatementsClient extends AbstractBillingClient
{
    /**
     * @var string periodFrom index
     */
    public const PERIOD_FROM = 'periodFrom';

    /**
     * @var string periodTo index
     */
    public const PERIOD_TO = 'periodTo';

    /**
     * @param string $reference
     *
     * @return Statement|null
     *
     * @throws EntityValidationException
     * @throws NotFoundException
     * @throws PublicApiClientException|\ReflectionException
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
     * @param string $periodFrom YYYY-MM
     * @param string $periodTo YYYY-MM
     *
     * @return Generator|Statement[]
     *
     * @throws EntityValidationException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getStatements(string $periodFrom, string $periodTo): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);

            $rawResponse = $this->getStatementsRaw($periodFrom, $periodTo);
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
     * @param string $periodFrom YYYY-MM
     * @param string $periodTo YYYY-MM
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getStatementsRaw(string $periodFrom, string $periodTo): string
    {
        $this->path = '/statements';
        $parameters = [
            self::PERIOD_FROM => $periodFrom,
            self::PERIOD_TO   => $periodTo,
        ];

        return $this->get($parameters);
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
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws PublicApiClientException
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
}
