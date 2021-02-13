<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Program;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use Generator;

/**
 * Class ProgramClient
 */
class ProgramClient extends AbstractCatalogClient
{
    /**
     * Provides all programs of given classification.
     * Returns the raw data from the API.
     *
     * @param string $classification
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getProgramsRaw(string $classification): string
    {
        $classification = urlencode($classification);

        $this->path = "/categories/$classification/programs";

        return $this->get();
    }

    /**
     * Provides all programs of given classification.
     * Returns an array (generator) of Program.
     *
     * @param string $classification
     *
     * @return Generator|Program[]
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getPrograms(string $classification): Generator
    {
        $this->setPerPage(100);
        $currentPage = 1;
        $lastPage = false;

        while (! $lastPage) {
            $this->setPage($currentPage);
            $rawResponse = $this->getProgramsRaw($classification);
            $response = $this->decodeResponse($rawResponse);

            if ($response['pagination']['total_page'] <= $currentPage) {
                $lastPage = true;
            }

            $currentPage++;

            foreach ($response['data'] as $data) {
                yield new Program($data);
            }
        }
    }

    /**
     * Gets a single program.
     *
     * Returns the raw data from the API.
     *
     * @param string $classification
     * @param string $program
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getProgramRaw(string $classification, string $program): string
    {
        $classification = urlencode($classification);
        $program = urlencode($program);

        $this->path = "/categories/$classification/programs/$program";

        return $this->get();
    }

    /**
     * Gets a single program.
     *
     * @param string $classification
     * @param string $program
     *
     * @return Program
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getProgram(string $classification, string $program): Program
    {
        $rawResponse = $this->getProgramRaw($classification, $program);
        $response = $this->decodeResponse($rawResponse);

        return new Program($response['data']);
    }
}
