<?php

namespace ArrowSphere\PublicApiClient\Licenses\Enum;

use ArrowSphere\PublicApiClient\AbstractEnum;
use ArrowSphere\PublicApiClient\Licenses\Entities\License\ActiveSeats;
use ArrowSphere\PublicApiClient\Licenses\Entities\License\License;
use ArrowSphere\PublicApiClient\Licenses\Entities\License\Price;
use ArrowSphere\PublicApiClient\Licenses\Entities\License\Security;
use ArrowSphere\PublicApiClient\Licenses\Entities\LicenseOfferFindResult;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\ActionFlags;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\Offer;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\ActionFlags as PriceBandActionFlags;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Billing;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Identifiers\Arrowsphere;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\Prices;
use ArrowSphere\PublicApiClient\Licenses\Entities\Offer\PriceBand\SaleConstraints;

/**
 * Class LicenseFindFieldEnum
 *
 * These consts are meant to be used with LicensesClient, with DATA_KEYWORDS, DATA_FILTERS and DATA_SORT options.
 */
class LicenseFindFieldEnum extends AbstractEnum
{
    public const LICENSE_ID = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_ID;

    public const LICENSE_SUBSCRIPTION_ID = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_SUBSCRIPTION_ID;

    public const LICENSE_PARENT_LINE_ID = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_PARENT_LINE_ID;

    public const LICENSE_PARENT_ORDER_REF = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_PARENT_ORDER_REF;

    public const LICENSE_VENDOR_NAME = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_VENDOR_NAME;

    public const LICENSE_VENDOR_CODE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_VENDOR_CODE;

    public const LICENSE_SUBSIDIARY_NAME = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_SUBSIDIARY_NAME;

    public const LICENSE_PARTNER_REF = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_PARTNER_REF;

    public const LICENSE_STATUS_CODE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_STATUS_CODE;

    public const LICENSE_STATUS_LABEL = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_STATUS_LABEL;

    public const LICENSE_SERVICE_REF = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_SERVICE_REF;

    public const LICENSE_SKU = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_SKU;

    public const LICENSE_UOM = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_UOM;

    public const LICENSE_PRICE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_PRICE;

    public const LICENSE_PRICE_PRICE_BAND_ARROWSPHERE_SKU = self::LICENSE_PRICE . '.' . Price::COLUMN_PRICE_BAND_ARROWSPHERE_SKU;

    public const LICENSE_PRICE_BUY_PRICE = self::LICENSE_PRICE . '.' . Price::COLUMN_BUY_PRICE;

    public const LICENSE_PRICE_SELL_PRICE = self::LICENSE_PRICE . '.' . Price::COLUMN_SELL_PRICE;

    public const LICENSE_PRICE_LIST_PRICE = self::LICENSE_PRICE . '.' . Price::COLUMN_LIST_PRICE;

    public const LICENSE_PRICE_TOTAL_BUY_PRICE = self::LICENSE_PRICE . '.' . Price::COLUMN_TOTAL_BUY_PRICE;

    public const LICENSE_PRICE_TOTAL_SELL_PRICE = self::LICENSE_PRICE . '.' . Price::COLUMN_TOTAL_SELL_PRICE;

    public const LICENSE_PRICE_TOTAL_LIST_PRICE = self::LICENSE_PRICE . '.' . Price::COLUMN_TOTAL_LIST_PRICE;

    public const LICENSE_PRICE_CURRENCY = self::LICENSE_PRICE . '.' . Price::COLUMN_CURRENCY;

    public const LICENSE_CLOUD_TYPE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_CLOUD_TYPE;

    public const LICENSE_BASE_SEAT = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_BASE_SEAT;

    public const LICENSE_SEAT = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_SEAT;

    public const LICENSE_TRIAL = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_TRIAL;

    public const LICENSE_AUTO_RENEW = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_AUTO_RENEW;

    public const LICENSE_OFFER = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_OFFER;

    public const LICENSE_CATEGORY = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_CATEGORY;

    public const LICENSE_TYPE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_TYPE;

    public const LICENSE_START_DATE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_START_DATE;

    public const LICENSE_END_DATE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_END_DATE;

    public const LICENSE_ACCEPT_EULA = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_ACCEPT_EULA;

    public const LICENSE_CUSTOMER_REF = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_CUSTOMER_REF;

    public const LICENSE_CUSTOMER_VENDOR_REF = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_CUSTOMER_VENDOR_REFERENCE;

    public const LICENSE_CUSTOMER_NAME = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_CUSTOMER_NAME;

    public const LICENSE_COLUMN_CUSTOMER_VENDOR_REFERENCE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_CUSTOMER_VENDOR_REFERENCE;

    public const LICENSE_RESELLER_REF = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_RESELLER_REF;

    public const LICENSE_RESELLER_NAME = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_RESELLER_NAME;

    public const LICENSE_MARKETPLACE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_MARKETPLACE;

    public const LICENSE_ACTIVE_SEATS = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_ACTIVE_SEATS;

    public const LICENSE_ACTIVE_SEATS_NUMBER = self::LICENSE_ACTIVE_SEATS . '.' . ActiveSeats::COLUMN_NUMBER;

    public const LICENSE_ACTIVE_SEATS_LAST_UPDATE = self::LICENSE_ACTIVE_SEATS . '.' . ActiveSeats::COLUMN_LAST_UPDATE;

    public const LICENSE_FRIENDLY_NAME = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_FRIENDLY_NAME;

    public const LICENSE_VENDOR_SUBSCRIPTION_ID = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_VENDOR_SUBSCRIPTION_ID;

    public const LICENSE_MESSAGE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_MESSAGE;

    public const LICENSE_NEXT_RENEWAL_DATE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_NEXT_RENEWAL_DATE;

    public const LICENSE_PERIODICITY = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_PERIODICITY;

    public const LICENSE_TERM = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_TERM;

    public const LICENSE_IS_ENABLED = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_IS_ENABLED;

    public const LICENSE_CONFIGS = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_CONFIGS;

    public const LICENSE_LAST_UPDATE = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_LAST_UPDATE;

    public const LICENSE_WARNINGS = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_WARNINGS;

    public const LICENSE_VENDOR_BILLING_ID = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_VENDOR_BILLING_ID;

    public const OFFER_NAME = LicenseOfferFindResult::COLUMN_OFFER . '.' . Offer::COLUMN_NAME;

    public const OFFER_CLASSIFICATION = LicenseOfferFindResult::COLUMN_OFFER . '.' . Offer::COLUMN_CLASSIFICATION;

    public const OFFER_IS_ENABLED = LicenseOfferFindResult::COLUMN_OFFER . '.' . Offer::COLUMN_IS_ENABLED;

    public const OFFER_ACTION_FLAGS = LicenseOfferFindResult::COLUMN_OFFER . '.' . Offer::COLUMN_ACTION_FLAGS;

    public const OFFER_ACTION_FLAGS_IS_AUTO_RENEW = self::OFFER_ACTION_FLAGS . '.' . ActionFlags::COLUMN_IS_AUTO_RENEW;

    public const OFFER_ACTION_FLAGS_MANUAL_PROVISIONING = self::OFFER_ACTION_FLAGS . '.' . ActionFlags::COLUMN_MANUAL_PROVISIONING;

    public const OFFER_ACTION_FLAGS_RENEWAL_SKU = self::OFFER_ACTION_FLAGS . '.' . ActionFlags::COLUMN_RENEWAL_SKU;

    public const OFFER_PRICE_BAND = LicenseOfferFindResult::COLUMN_OFFER . '.' . Offer::COLUMN_PRICE_BAND;

    public const OFFER_PRICE_BAND_IS_ENABLED = self::OFFER_PRICE_BAND . '.' . PriceBand::COLUMN_IS_ENABLED;

    public const OFFER_PRICE_BAND_ACTION_FLAGS = self::OFFER_PRICE_BAND . '.' . PriceBand::COLUMN_ACTION_FLAGS;

    public const OFFER_PRICE_BAND_ACTION_FLAGS_CAN_BE_CANCELLED = self::OFFER_PRICE_BAND_ACTION_FLAGS . '.' . PriceBandActionFlags::COLUMN_CAN_BE_CANCELLED;

    public const OFFER_PRICE_BAND_ACTION_FLAGS_CAN_BE_REACTIVATED = self::OFFER_PRICE_BAND_ACTION_FLAGS . '.' . PriceBandActionFlags::COLUMN_CAN_BE_REACTIVATED;

    public const OFFER_PRICE_BAND_ACTION_FLAGS_CAN_BE_SUSPENDED = self::OFFER_PRICE_BAND_ACTION_FLAGS . '.' . PriceBandActionFlags::COLUMN_CAN_BE_SUSPENDED;

    public const OFFER_PRICE_BAND_ACTION_FLAGS_CAN_DECREASE_SEATS = self::OFFER_PRICE_BAND_ACTION_FLAGS . '.' . PriceBandActionFlags::COLUMN_CAN_DECREASE_SEATS;

    public const OFFER_PRICE_BAND_ACTION_FLAGS_CAN_INCREASE_SEATS = self::OFFER_PRICE_BAND_ACTION_FLAGS . '.' . PriceBandActionFlags::COLUMN_CAN_INCREASE_SEATS;

    public const OFFER_PRICE_BAND_BILLING = self::OFFER_PRICE_BAND . '.' . PriceBand::COLUMN_BILLING;

    public const OFFER_PRICE_BAND_BILLING_CYCLE = self::OFFER_PRICE_BAND_BILLING . '.' . Billing::COLUMN_CYCLE;

    public const OFFER_PRICE_BAND_BILLING_TERM = self::OFFER_PRICE_BAND_BILLING . '.' . Billing::COLUMN_TERM;

    public const OFFER_PRICE_BAND_BILLING_TYPE = self::OFFER_PRICE_BAND_BILLING . '.' . Billing::COLUMN_TYPE;

    public const OFFER_PRICE_BAND_CURRENCY = self::OFFER_PRICE_BAND . '.' . PriceBand::COLUMN_CURRENCY;

    public const OFFER_PRICE_BAND_MARKETPLACE = self::OFFER_PRICE_BAND . '.' . PriceBand::COLUMN_MARKETPLACE;

    public const OFFER_PRICE_BAND_PRICES = self::OFFER_PRICE_BAND . '.' . PriceBand::COLUMN_PRICES;

    public const OFFER_PRICE_BAND_PRICES_BUY = self::OFFER_PRICE_BAND_PRICES . '.' . Prices::COLUMN_BUY;

    public const OFFER_PRICE_BAND_PRICES_SELL = self::OFFER_PRICE_BAND_PRICES . '.' . Prices::COLUMN_SELL;

    public const OFFER_PRICE_BAND_PRICES_PUBLIC = self::OFFER_PRICE_BAND_PRICES . '.' . Prices::COLUMN_PUBLIC;

    public const OFFER_PRICE_BAND_SALE_CONSTRAINTS = self::OFFER_PRICE_BAND . '.' . PriceBand::COLUMN_SALE_CONSTRAINTS;

    public const OFFER_PRICE_BAND_SALE_CONSTRAINTS_MIN_QUANTITY = self::OFFER_PRICE_BAND_SALE_CONSTRAINTS . '.' . SaleConstraints::COLUMN_MIN_QUANTITY;

    public const OFFER_PRICE_BAND_SALE_CONSTRAINTS_MAX_QUANTITY = self::OFFER_PRICE_BAND_SALE_CONSTRAINTS . '.' . SaleConstraints::COLUMN_MAX_QUANTITY;

    public const OFFER_PRICE_BAND_IDENTIFIERS = self::OFFER_PRICE_BAND . '.' . PriceBand::COLUMN_IDENTIFIERS;

    public const OFFER_PRICE_BAND_IDENTIFIERS_ARROWSPHERE = self::OFFER_PRICE_BAND_IDENTIFIERS . '.' . Identifiers::COLUMN_ARROWSPHERE;

    public const OFFER_PRICE_BAND_IDENTIFIERS_ARROWSPHERE_SKU = self::OFFER_PRICE_BAND_IDENTIFIERS_ARROWSPHERE . '.' . Arrowsphere::COLUMN_SKU;

    public const OFFER_LAST_UPDATE = LicenseOfferFindResult::COLUMN_OFFER . '.' . Offer::COLUMN_LAST_UPDATE;

    public const OFFER_ARROW_SUB_CATEGORIES = LicenseOfferFindResult::COLUMN_OFFER . '.' . Offer::COLUMN_ARROW_SUB_CATEGORIES;

    public const LICENSE_SECURITY = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_SECURITY;
    public const LICENSE_SECURITY_ACTIVE_FRAUD_EVENTS = LicenseOfferFindResult::COLUMN_LICENSE . '.' . License::COLUMN_SECURITY . '.' . Security::COLUMN_ACTIVE_FRAUD_EVENTS;
}
