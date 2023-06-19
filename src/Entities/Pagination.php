<?php

namespace ArrowSphere\PublicApiClient\Entities;

class Pagination
{
    public const PAGINATION_PER_PAGE = 'per_page';
    public const PAGINATION_CURRENT_PAGE = 'current_page';
    public const PAGINATION_TOTAL_PAGE = 'total_page';
    public const PAGINATION_TOTAL = 'total';
    public const PAGINATION_NEXT_PAGE = 'next';
    public const PAGINATION_PREVIOUS_PAGE = 'previous';

    /**
     * @var int
     */
    private $perPage;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * @var int|null
     */
    private $totalPage;

    /**
     * @var int|null
     */
    private $total;

    /**
     * @var string
     */
    private $nextPage;

    /**
     * @var string
     */
    private $previousPage;

    public function __construct(array $data)
    {
        $this->perPage = $data[self::PAGINATION_PER_PAGE] ?? null;
        $this->currentPage = $data[self::PAGINATION_CURRENT_PAGE] ?? 1;
        $this->totalPage = $data[self::PAGINATION_TOTAL_PAGE] ?? null;
        $this->total = $data[self::PAGINATION_TOTAL] ?? null;
        $this->nextPage = $data[self::PAGINATION_NEXT_PAGE] ?? '';
        $this->previousPage = $data[self::PAGINATION_PREVIOUS_PAGE] ?? '';
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            self::PAGINATION_PER_PAGE => $this->getPerPage(),
            self::PAGINATION_CURRENT_PAGE => $this->getCurrentPage(),
            self::PAGINATION_TOTAL_PAGE => $this->getTotalPage(),
            self::PAGINATION_TOTAL => $this->getTotal(),
            self::PAGINATION_NEXT_PAGE => $this->getNextPage(),
            self::PAGINATION_PREVIOUS_PAGE => $this->getPreviousPage(),
        ];
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int|null
     */
    public function getTotalPage(): ?int
    {
        return $this->totalPage;
    }

    /**
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * @return string
     */
    public function getPreviousPage(): string
    {
        return $this->previousPage;
    }

    /**
     * @return string
     */
    public function getNextPage(): string
    {
        return $this->nextPage;
    }
}
