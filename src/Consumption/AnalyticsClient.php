<?php

namespace ArrowSphere\PublicApiClient\Consumption;

use ArrowSphere\PublicApiClient\Consumption\Entities\MonthlyAnalyticsItem;
use ArrowSphere\PublicApiClient\Consumption\Enum\ConstantEnum;
use ArrowSphere\PublicApiClient\Exception\NotFoundException;
use ArrowSphere\PublicApiClient\Exception\PublicApiClientException;
use ReflectionException;

/**
 * Class HealthCheckClient
 */
class AnalyticsClient extends AbstractConsumptionClient
{
    /**
     * @param string $month The target month format: YYYY-MM (2020-06)
     * @param string[] $classification The list of classification (SAAS, IAAS...)
     * @param string[] $vendorCode The list of vendor code (microsoft, bittitan...)
     * @param string[] $marketPlace The list of marketPlace (FR, UK, US...)
     * @param string[] $license The list of subscription reference to filter (XSP1234, XSP67)
     * @param string $tag The target tag filter (Pax8, TELENOR ...)
     *
     * @return MonthlyAnalyticsItem[]
     * @throws PublicApiClientException|ReflectionException
     */
    public function getMonthly(string $month, array $classification = [], array $vendorCode = [], array $marketPlace = [], array $license = [], string $tag = null) : array
    {
        $response = $this->getMonthlyRaw($month, $classification, $vendorCode, $marketPlace, $license, $tag);
        $data = $this->decodeResponse($response);

        $result = [];
        if ($data['data']) {
            foreach ($data['data'] as $item) {
                $result[] = new MonthlyAnalyticsItem($item);
            }
        }

        return $result;
    }

    /**
     * @param string $month The target month format: YYYY-MM (2020-06)
     * @param string[] $classification The list of classification (SAAS, IAAS...)
     * @param string[] $vendorCode The list of vendor code (microsoft, bittitan...)
     * @param string[] $marketPlace The list of marketPlace (FR, UK, US...)
     * @param string[] $license The list of license reference to filter (XSP1234, XSP67)
     * @param string $tag The target tag filter (Pax8, TELENOR ...)
     *
     * @return string
     *
     * @throws NotFoundException
     * @throws PublicApiClientException
     */
    public function getMonthlyRaw(string $month, array $classification = [], array $vendorCode = [], array $marketPlace = [], array $license = [],  $tag = null): string
    {
        $this->path = '/analytics/monthly';

        return $this->get([
            'month'                      => $month,
            ConstantEnum::CLASSIFICATION => $classification,
            ConstantEnum::VENDOR         => $vendorCode,
            ConstantEnum::MARKETPLACE    => $marketPlace,
            ConstantEnum::LICENSE        => $license,
            ConstantEnum::TAG            => $tag
        ]);
    }
}