<?php

namespace ArrowSphere\PublicApiClient\Tests\Catalog\Entities;

use ArrowSphere\PublicApiClient\Catalog\Entities\Offer;
use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
    /**
     * @throws EntityValidationException
     */
    public function testOfferSerialisation(): void
    {
        $offer = new Offer([
            "marketplace"                   => "US",
            "sku"                           => "CAFF2897-D629-404A-A241-6B360E979609",
            "name"                          => "Dynamics 365 Customer Voice Addl Responses",
            "associatedSubscriptionProgram" => "MSCSP",
            "vendor"                        => "Microsoft",
            "vendor_code"                   => "microsoft",
            "description"                   => "description",
            "thumbnail"                     => "https://websource.myportal.cloud/images/Office365.jpg",
            "customer_category"             => '',
            "category"                      => ["Productivity"],
            "has_addons"                    => false,
            "is_addon"                      => false,
            "is_trial"                      => false,
            "product"                       => "MS-0B-O365-ENTERPRIS",
            "program"                       => "microsoft",
            "type"                          => "SAAS",
            "keywords"                      => ["Corporate"],
            "weight_top_sales"              => 11.173757047667863,
            "weight_forced"                 => 0,
            "isEnabled"                     => true,
            "service_ref"                   => "MS-0A-O365-BUSINESS",
            "service_name"                  => "Office 365 Business – (Corporate)",
            "orderableSku"                  => "U0FBU3x8bWljcm9zb2Z0fHxNUy0wQi1PMzY1LUVOVEVSUFJJU3x8Q0FGRjI4OTctRDYyOS00MDRBLUEyNDEtNkIzNjBFOTc5NjA5",
            "prices"                        => [
                [
                    "min_quantity"        => 1,
                    "max_quantity"        => 10000000,
                    "recurring_buy_price" => 50,
                    "recurring_sell_price"=> 70,
                    "term"                => "1 Year",
                    "unit_type"           => "LICENSE",
                    "periodicity"         => "per Month",
                    "recurring_time_unit" => "per Month",
                    "setup_buy_price"     => 0,
                    "setup_sell_price"    => 0,
                    "setup_time_unit"     => "One-Time",
                    "currency"            => "USD",
                    "period_as_hours"     => "720",
                    "term_as_hours"       => 8640,
                    "availability_date"   => "2020-11-01T00:00:00+00:00",
                    "expiry_date"         => "9999-12-31T00:00:00+00:00"
                ], [
                    "min_quantity"        => 1,
                    "max_quantity"        => 10000000,
                    "recurring_buy_price" => 600,
                    "recurring_sell_price"=> 800,
                    "term"                => "1 Year",
                    "unit_type"           => "LICENSE",
                    "periodicity"         => "per Year",
                    "recurring_time_unit" => "per Year",
                    "setup_buy_price"     => 0,
                    "setup_sell_price"    => 0,
                    "period_as_hours"     => "8640",
                    "term_as_hours"       => 8640,
                    "setup_time_unit"     => "One-Time",
                    "currency"            => "USD",
                    "availability_date"   => "2020-11-01T00:00:00+00:00",
                    "expiry_date"         => "9999-12-31T00:00:00+00:00"
                ]
            ],
            "buyingProgram"                 =>  "Corporate",
            "buyingType"                    =>  "PAYGO",
            "endUserEula"                   =>  "end user eula",
            "endUserFeatures"               =>  "end user features",
            "endUserRequirements"           =>  "end user requirements",
            "links"                         => [
                "program" => "/api/catalog/categories/SAAS/programs/microsoft",
                "product" => "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS",
                "offer"   => "/api/catalog/categories/SAAS/programs/microsoft/products/MS-0B-O365-ENTERPRIS/offers/CAFF2897-D629-404A-A241-6B360E979609"
            ],
            "eula"                          => "eula"
        ]);

        self::assertEquals('{"category":["Productivity"],"customer_category":"","has_addons":false,"is_addon":false,"is_trial":false,"keywords":["Corporate"],"marketplace":"US","name":"Dynamics 365 Customer Voice Addl Responses","service_name":"Office 365 Business \u2013 (Corporate)","service_ref":"MS-0A-O365-BUSINESS","sku":"CAFF2897-D629-404A-A241-6B360E979609","thumbnail":"https:\/\/websource.myportal.cloud\/images\/Office365.jpg","type":"SAAS","vendor":"Microsoft","vendor_code":"microsoft","weight_forced":0,"weight_top_sales":11.173757047667863,"prices":[{"min_quantity":1,"max_quantity":10000000,"recurring_buy_price":50,"recurring_sell_price":70,"arrow_price":null,"term":"1 Year","unit_type":"LICENSE","recurring_time_unit":"per Month","currency":"USD","period_as_hours":720,"term_as_hours":8640},{"min_quantity":1,"max_quantity":10000000,"recurring_buy_price":600,"recurring_sell_price":800,"arrow_price":null,"term":"1 Year","unit_type":"LICENSE","recurring_time_unit":"per Year","currency":"USD","period_as_hours":8640,"term_as_hours":8640}],"add_ons":null,"buying_program":null,"conversion_skus":null,"description":"description","end_customer_features":null,"eula":"eula","isEnabled":true,"program.isEnabled":true,"orderable_sku":null,"related_offers":[],"service_description":null,"features_picture":null,"full_features":null,"prerequisites":null,"requirements":null,"short_features":null}', json_encode($offer));

    }
}