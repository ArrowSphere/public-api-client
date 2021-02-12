<?php

namespace ArrowSphere\PublicApiClient\Catalog;

use ArrowSphere\PublicApiClient\Catalog\Entities\Offer;
use ArrowSphere\PublicApiClient\Catalog\Entities\PriceBand;

trait LegacyOfferConverterTrait
{
    /**
     * @var array
     */
    private $conversionPeriodicityToPeriodAsHours = [
        'One-Time'                       => 0,
        'per Hour'                       => 1,
        'per Day'                        => 24,
        'per Month'                      => 720,
        'per Month (based on 730 hours)' => 730,
        'per Month (based on 744 hours)' => 744,
        'per Quarter'                    => 2160,
        'per Six Months'                 => 4320,
        'per Year'                       => 8640,
        'per Two Years'                  => 17280,
        'per Three Years'                => 25920,
        'per Four Years'                 => 34560,
        'per Five Years'                 => 43200,
        'per Six Years'                  => 51840,
    ];

    /**
     * @var array
     */
    private $conversionTermToTermAsHours = [
        'No Term'        => 0,
        'Month-to-Month' => 720,
        '3 Months'       => 2160,
        '6 Months'       => 4320,
        '1 Year'         => 8640,
        '2 Years'        => 17280,
        '3 Years'        => 25920,
        '4 Years'        => 34560,
        '5 Years'        => 43200,
        '6 Years'        => 51840,
    ];

    private function convertLegacyOfferPayload(array $data): array
    {
        return [
            Offer::COLUMN_NAME                  => $data['name'],
            Offer::COLUMN_SKU                   => $data['reference'],
            Offer::COLUMN_VENDOR                => $data['vendor'],
            Offer::COLUMN_VENDOR_CODE           => $data['program'],
            Offer::COLUMN_ADDONS                => [],
            Offer::COLUMN_PREREQUISITES         => $data['addonParents'] ?? [],
            //$data['associatedSubscriptionProgram'],
            Offer::COLUMN_DESCRIPTION           => $data['description'],
            Offer::COLUMN_HAS_ADDONS            => $data['hasAddon'],
            Offer::COLUMN_IS_ADDON              => $data['isAddon'],
            Offer::COLUMN_IS_TRIAL              => $data['isTrial'],
            Offer::COLUMN_SERVICE_REF           => $data['product'],
            Offer::COLUMN_CATEGORY              => [],
            Offer::COLUMN_ORDERABLE_SKU         => $data['orderableSku'],
            'prices'                            => $this->convertLegacyPricesPayload($data['prices']),
            Offer::COLUMN_BUYING_PROGRAM        => $data['buyingProgram'],
            $data['buyingType'],
            $data['endUserEula'],
            Offer::COLUMN_END_CUSTOMER_FEATURES => $data['endUserFeatures'],
            // $data['endUserRequirements'],
            Offer::COLUMN_EULA                  => $data['eula'] ?? null,
            Offer::COLUMN_TYPE                  => $data['category'],
            Offer::COLUMN_CUSTOMER_CATEGORY     => '',
            Offer::COLUMN_IS_ENABLED            => true,
            Offer::COLUMN_KEYWORDS              => [],
            Offer::COLUMN_MARKETPLACE           => 'N/A',
            'program'                           => [
                'isEnabled' => true,
            ],
            Offer::COLUMN_SERVICE_NAME          => '',
            Offer::COLUMN_THUMBNAIL             => '',
            Offer::COLUMN_WEIGHT_FORCED         => 0,
            Offer::COLUMN_WEIGHT_TOP_SALES      => 0,
        ];
    }

    private function convertLegacyPricesPayload(array $data): array
    {
        return array_map(function (array $row) {
            return [
                PriceBand::COLUMN_MIN_QUANTITY => $row['min_quantity'],// int(1)
                PriceBand::COLUMN_MAX_QUANTITY => $row['max_quantity'],// NULL
                PriceBand::COLUMN_RECURRING_BUY_PRICE => $row['recurring_buy_price'],// int(12)
                PriceBand::COLUMN_RECURRING_SELL_PRICE => $row['recurring_sell_price'],// int(12)
                PriceBand::COLUMN_TERM => $row['term'],// string(7) "No Term"
                PriceBand::COLUMN_UNIT_TYPE => $row['unit_type'],// string(7) "LICENSE"
                //$row['periodicity'],// string(9) "per Month"
                PriceBand::COLUMN_RECURRING_TIME_UNIT => $row['recurring_time_unit'],// string(9) "per Month"
                //$row['setup_buy_price'],// int(0)
                //$row['setup_sell_price'],// int(0)
                //$row['setup_time_unit'],// string(8) "One-Time"
                PriceBand::COLUMN_CURRENCY => $row['currency'],// string(3) "EUR"
                //$row['availability_date'],// string(0) ""
                //$row['expiry_date'],// string(0) ""
                PriceBand::COLUMN_PERIOD_AS_HOURS => $this->conversionPeriodicityToPeriodAsHours[$row['periodicity']] ?? 0,
                PriceBand::COLUMN_TERM_AS_HOURS => $this->conversionTermToTermAsHours[$row['term']] ?? 0,
            ];
        }, $data);
    }
}
