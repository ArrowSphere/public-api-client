<?php

namespace ArrowSphere\PublicApiClient\Consumption;

use ArrowSphere\PublicApiClient\Consumption\Entities\MonthlyAnalyticsItem;
use ArrowSphere\PublicApiClient\Consumption\Enum\ConstantEnum;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;

/**
 * Class HealthCheckClient
 */
class AnalyticsClient extends AbstractConsumptionClient
{
    /**
     * @param string $month The target month format: YYYY-MM (2020-06)
     * @param array $classification The list of classification (SAAS, IAAS...)
     * @param array $vendorCode The list of vendor code (microsoft, bittitan...)
     * @param array $marketPlace The list of marketPlace (FR, UK, US...)
     * @param string $tag The target tag filter (Pax8, TELENOR ...)
     *
     * @return MonthlyAnalyticsItem[]
     * @throws PublicApiClientException
     */
    public function getMonthly(string $month, array $classification = [], array $vendorCode = [], array $marketPlace = [], string $tag = null) : array
    {
        $response = $this->getMonthlyRaw($month, $classification, $vendorCode, $marketPlace, $tag);
        $data = $this->decodeResponse($response);

        $result = [];
        if ($data['data'] && $data['data']) {
            foreach ($data['data'] as $item) {
                $result[] = new MonthlyAnalyticsItem($item);
            }
        }

        return $result;
    }

    /**
     * @param string $month The target month format: YYYY-MM (2020-06)
     * @param array $classification The list of classification (SAAS, IAAS...)
     * @param array $vendorCode The list of vendor code (microsoft, bittitan...)
     * @param array $marketPlace The list of marketPlace (FR, UK, US...)
     * @param string $tag The target tag filter (Pax8, TELENOR ...)
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getMonthlyRaw(string $month, array $classification = [], array $vendorCode = [], array $marketPlace = [], string $tag = null): string
    {
        $this->path = '/analytics/monthly';

        return $this->get([
            'month'                      => $month,
            ConstantEnum::CLASSIFICATION => $classification,
            ConstantEnum::VENDOR         => $vendorCode,
            ConstantEnum::MARKETPLACE    => $marketPlace,
            ConstantEnum::TAG            => $tag
        ]);
    }
}