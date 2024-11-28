# License Client

## General information

A license is the entity which holds information about the customer's subscription.
A license is identified in ArrowSphere Cloud by its _partner ref_, which is typically 'XSP' followed by a few digits (e.g XSP987654321).

## Entities

### License and its sub-entities


#### AwsPayerAccount

The AwsPayerAccount represent the AWS payer account for a specific endCustomerRef.

| Field           | Type      | Example | Description                                       |
|-----------------|-----------|---------|---------------------------------------------------|
| type            | `string`  | "arrow" | License type can be (arrow, partner, endCustomer) |
| friendlyName    | `string`  | "test"  | License friendly name                             |
| licenseRef      | `string`  | "XSP"   | License reference                                 |


#### License

A license is managed by the `License` entity.

| Field                   | Type          | Example                                    | Description                                                                                           |
|-------------------------|---------------|--------------------------------------------|-------------------------------------------------------------------------------------------------------|
| acceptEula              | `bool`        | false                                      |                                                                                                       |
| activeSeats             | `ActiveSeats` | an instance of [ActiveSeats](#ActiveSeats) | The [active seats](#ActiveSeats)                                                                      |
| autoRenew               | `bool`        | true                                       | True if the license is renewed automatically upon expiration                                          |
| baseSeat                | `int`         | 6                                          | The number of seats at the time of the license purchase                                               |
| category                | `string`      | BaseProduct                                | Indicates if the offer is a BaseProduct or an Addon                                                   |
| classification          | `string`      | SaaS                                       | The [classification](catalog-classification.md)                                                       |
| configs                 | `Config[]`    | an array of [Configs](#Config)             | The list of applicable [configs](#Config) for this license                                            |
| customerName            | `string`      | My customer                                | The name of the end-customer                                                                          |
| customerRef             | `string`      | XSP123456789                               | The reference of the end-customer                                                                     |
| customerVendorReference | `string`      | ABCDABCD-1234-5678-9876-ABCDEFABCDEF       | The customer Vendor reference (tenant ID for Microsoft)                                               |
| endDate                 | `string`      | 2021-11-18T17:48:43.000Z                   | The end date of the license                                                                           |
| friendlyName            | `string`      | XSP12345                                   | MS-0B-O365-ENTERPRIS                                                                                  |
| id                      | `int`         | 123456                                     | The license identifier (an internal identifier)                                                       |
| isEnabled               | `bool`        | true                                       | True if the license is active                                                                         |
| lastUpdate              | `string`      | 2020-12-08T15:42:30.069Z                   | The last time the license's data was updated (for any reason)                                         |
| marketplace             | `string`      | US                                         | The [marketplace](general-marketplace.md)                                                             |
| message                 | `string`      |                                            | If an action is currently performed on the license, this message will indicate it                     |
| offer                   | `string`      |                                            | The name of the offer                                                                                 |
| parentLineId            | `int`         | null                                       | An internal reference indicating a parent license for this license                                    |
| parentOrderRef          | `string`      | null                                       | An internal reference indicating a parent order                                                       |
| partnerRef              | `string`      | XSP987654321                               | The ArrowSphere identifier of the license, to be used as an identifier in other ArrowSphere endpoints |
| price                   | `Price`       | an instance of [Price](#Price)             | The [price](#Price)                                                                                   |
| periodicity             | `int`         | 720                                        | The license's billing cycle (See [Term ans periodicity](#term-and-periodicity)                        |
| resellerName            | `string`      | My reseller                                | The name of the reseller                                                                              |
| resellerRef             | `string`      | XSP12345                                   | The reference of the reseller                                                                         |
| seat                    | `int`         | 6                                          | The number of available seats                                                                         |
| serviceRef              | `string`      | MS-0B-O365-ENTERPRIS                       | The family identifier for this SKU (See [services](catalog-service.md))                               |
| sku                     | `string`      | ABCDABCD-1234-5678-9876-ABCDEFABCDEF       | The SKU of the license                                                                                |
| startDate               | `string`      | 2020-11-18T17:48:43.000Z                   | The start date of the license                                                                         |
| statusCode              | `int`         | 86                                         | An internal code indicating the status of the license                                                 |
| statusLabel             | `float`       | activation_ok                              | An internal label indicating the status of the license                                                |
| subscriptionId          | `string`      | 12345678-AAAA-CCCC-FFFF-987654321012       | Another internal identifier for the license                                                           |
| subsidiaryName          | `string`      | Arrow ECS Denmark                          | The arrow company that manages the license                                                            |
| term                    | `int`         | 8640                                       | The license's term (See [Term ans periodicity](#term-and-periodicity)                                 |
| trial                   | `bool`        | false                                      | True if the license is a trial                                                                        |
| type                    | `string`      | recurring                                  |                                                                                                       |
| uom                     | `string`      | LICENSE                                    | The unit of measure, is the unit of what is billed for this offer                                     |
| vendorBillingId         | `string`      | ABC123                                     | The vendor billing id of the license                                                                  |
| vendorCode              | `string`      | Microsoft                                  | The vendor code of the offer                                                                          |
| vendorName              | `string`      | Microsoft                                  | The vendor of the offer                                                                               |
| vendorSubscriptionId    | `string`      | AABBCCDD-1111-2222-3333-ABCDEFABCDEF       | An external identifier for the license                                                                |
| warnings                | `Warning[]`   | an array of [Warnings](#Warning)           | The list of [warnings](#Warning) for this license                                                     |

#### ActiveSeats

The active seats represent the seats that are currently assigned on the license. Depending on the vendor, it may or may not be applicable.

| Field      | Type     | Example                  | Description                                         |
|------------|----------|--------------------------|-----------------------------------------------------|
| lastUpdate | `string` | 2021-03-12T22:35:18.000Z | The last time the assigned seats have been modified |
| number     | `float`  | 12                       | The current number of assigned seats, if applicable |

#### Config

The config is a set of parameters that can be defined for a license.

| Field | Type     | Example              | Description                     |
|-------|----------|----------------------|---------------------------------|
| name  | `string` | purchaseReservations | The name of the config          |
| scope | `string` | role                 | The scope of the config         |
| state | `string` | enabled              | The current state of the config |

#### Warning

The warning is an alert for a license.

| Field   | Type     | Example                            | Description                |
|---------|----------|------------------------------------|----------------------------|
| key     | `string` | PEC ratio issue                    | The key of the warning     |
| message | `string` | current value is 0 instead of 0.15 | The message of the warning |

#### Price

The prices applicable at the time of the license purchase.

| Field                   | Type     | Example                                                      | Description                                              |
|-------------------------|----------|--------------------------------------------------------------|----------------------------------------------------------|
| buyPrice                | `float`  | 10.4                                                         | The buy price at the time of the license purchase        |
| sellPrice               | `float`  | 15.52                                                        | The sell price at the time of the license purchase       |
| listPrice               | `float`  | 15.52                                                        | The list price at the time of the license purchase       |
| totalBuyPrice           | `float`  | 10.4                                                         | The total buy price at the time of the license purchase  |
| totalSellPrice          | `float`  | 15.52                                                        | The total sell price at the time of the license purchase |
| totalListPrice          | `float`  | 15.52                                                        | The total list price at the time of the license purchase |
| currency                | `string` | USD                                                          | The currency used at the time of the license purchase    |
| priceBandArrowsphereSku | `string` | MS_195416C1_3447_423A_B37B_EE59A99A19C4_EUR_1_RECURRING_SEAT | the price band's sku                                     |

### Offer and its sub-entities

#### Offer

An offer is managed by the `Offer` entity.
This offer entity is essentially a subset of the original [Offer entity from the catalog](catalog-offer.md#Offer).
Its purpose is to present some fields of the offer linked to the license, updated in real-time, as opposed to the fields in the License entity, which represent data as it was the day of the order.

| Field          | Type          | Example                                                  | Description                                         |
|----------------|---------------|----------------------------------------------------------|-----------------------------------------------------|
| actionFlags    | `ActionFlags` | an instance of [ActionFlags](#ActionFlags for the Offer) | The possible actions for this offer                 |
| classification | `string`      | SaaS                                                     | The [classification](catalog-classification.md)     |
| isEnabled      | `bool`        | true                                                     | A flag that indicates if the offer is active        |
| lastUpdate     | `string`      | 2021-03-12T22:35:18.000Z                                 | The last time the offer was updated                 |
| name           | `string`      | The updated name of the offer                            | The current name of the offer, updated in real-time |
| priceBand      | `PriceBand`   | an instance of [PriceBand](#PriceBand)                   | The price band                                      |

#### ActionFlags for the Offer

| Field                | Type   | Example | Description                                           |
|----------------------|--------|---------|-------------------------------------------------------|
| isAutoRenew          | `bool` | true    | Indicates if the offer is auto-renewable of not       |
| isManualProvisioning | `bool` | false   | Indicates if the offer is provisioned manually or not |
| renewalSku           | `bool` | false   | Indicates if the offer is a renewal sku               |

#### PriceBand

| Field           | Type              | Example                                                      | Description                                       |
|-----------------|-------------------|--------------------------------------------------------------|---------------------------------------------------|
| actionFlags     | `ActionFlags`     | an instance of [ActionFlags](#ActionFlags for the PriceBand) | The possible actions for this price band          |
| billing         | `Billing`         | an instance of [Billing](#Billing)                           | The billing rules of the license                  |
| currency        | `string`          | USD                                                          | The currency of the price band                    |
| identifiers     | `Identifiers`     | an instance of [Identifiers](#Identifiers)                   | An object with some identifiers (sku...)          |
| isEnabled       | `bool`            | true                                                         | A flag that indicates if the price band is active |
| marketplace     | `string`          | US                                                           | The marketplace of the price band                 |
| prices          | `Prices`          | an instance of [Prices](#Prices)                             | The prices amounts of this price band             |
| saleConstraints | `SaleConstraints` | an instance of [SaleConstraints](#SaleConstraints)           | The min and max quantities of the price band      |

#### ActionFlags for the PriceBand

| Field            | Type   | Example | Description |
|------------------|--------|---------|-------------|
| canBeCancelled   | `bool` | true    |             |
| canBeReactivated | `bool` | true    |             |
| canBeSuspended   | `bool` | true    |             |
| canDecreaseSeats | `bool` | true    |             |
| canIncreaseSeats | `bool` | true    |             |

#### Billing

This entity describes how often the license is billed. See [Term and periodicity](#Term and periodicity) to view explanations about the billing cycle and term.

| Field | Type     | Example   | Description       |
|-------|----------|-----------|-------------------|
| cycle | `string` | 720       | The billing cycle |
| term  | `string` | 8640      | The term          |
| type  | `string` | RECURRING | The pricing type  |

#### Identifiers
| Field       | Type          | Example                                    | Description                                              |
|-------------|---------------|--------------------------------------------|----------------------------------------------------------|
| arrowsphere | `Arrowsphere` | An instance of [Arrowsphere](#Arrowsphere) | An object with some identifiers for arrowsphere (sku...) |

#### Prices

| Field  | Type    | Example | Description      |
|--------|---------|---------|------------------|
| buy    | `float` | 12.34   | The buy price    |
| sell   | `float` | 56.78   | The sell price   |
| public | `float` | 98.76   | The public price |

#### SaleConstraints

| Field       | Type    | Example | Description                                                        |
|-------------|---------|---------|--------------------------------------------------------------------|
| minQuantity | `float` | 1.0     | the minimum quantity required to purchase this offer at this price |
| maxQuantity | `float` | 1.0     | the maximum quantity required to purchase this offer at this price |

#### Arrowsphere
| Field | Type     | Example                                                      | Description          |
|-------|----------|--------------------------------------------------------------|----------------------|
| sku   | `string` | MS_195416C1_3447_423A_B37B_EE59A99A19C4_EUR_1_RECURRING_SEAT | the price band's sku |

### Other entities

#### FindResult

This entity is the main wrapper of the search result, returned by the [Find endpoint](#find-endpoint).
It contains the [filters](#FilterFindResult) and the [license/offers](#LicenseOfferFindResult) returned for the search.

#### FilterFindResult

This entity represents a filter returned by the [Find endpoint](#find-endpoint).
It shows a number of possible filters in the search results and the count for each of them.

| Field  | Type     | Example     | Description              |
|--------|----------|-------------|--------------------------|
| name   | `string` | vendor      | The name of the filter   |
| values | `array`  | (see below) | The values of the filter |

Each entry in the `values` array looks like this:

| Field | Type     | Example   | Description                                   |
|-------|----------|-----------|-----------------------------------------------|
| value | `string` | Microsoft | The value of the entry                        |
| count | `int`    | 3         | How many results are available for this entry |

The focus of these filters is to allow to display them to the user as a list of checkboxes
with how many results are available in each of them.

#### LicenseOfferFindResult

This entity represents a search result.
A search result is a combination of the [License](#License) entity and the [Offer](#Offer) entity.
All fields of both the [License](#License) entity and the [Offer](#Offer) entity are available.
This entity should be used to display search results or to make a listing of licenses.

| Field     | Type      | Example                           | Description                                                                                      |
|-----------|-----------|-----------------------------------|--------------------------------------------------------------------------------------------------|
| highlight | `array`   | ['sku' => '<strong>ABC</strong>'] | An associative array which shows which values are to be highlighted based on the search keywords |
| license   | `License` |                                   | All the fields contained in the [License](#License) entity                                       |
| offer     | `Offer`   |                                   | All the fields contained in the [Offer](#Offer) entity                                           |

Please note that the `highlight` field is only available if the `DATA_HIGHLIGHT` option is set to `true` while searching.

## Usage

The license client is simply called `LicensesClient`.
You can get it through the main entry point `PublicApiClient` and its method `getLicensesClient()`, or instantiate it directly.

## Term and periodicity

The term and periodicity are two key-concepts to understand in ArrowSphere Cloud.
These values represent time values, expressed as hours, using a basis of 24 hours a day, 30 days a month, 360 days a year.

The term is the customer's commitment. He has to pay as long as the term value.
The periodicity, also known as billing cycle, is the deadline at which the customer is billed.

For example, the typical license has a term of 8640 and a periodicity of 720, which means the customer is committed for 1 year, and he is billed every month.
Here are some possible values for these values:

| value | Term         | Periodicity                 |
|-------|--------------|-----------------------------|
| 0     | No term      | one time (no billing cycle) |
| 24    | One day      | Daily                       |
| 720   | One month    | Monthly                     |
| 2160  | Three months | Per quarter                 |
| 8640  | One year     | Yearly                      |

### Find endpoint

The "Find" endpoint has been designed specifically to perform quick and easy search through the licenses.
This is the endpoint called by xSP on its search bar and on the listing pages

The postData is supposed to contain the following keys:

- `LicensesClient::DATA_KEYWORD`: a string to be searched in all the fields. Supports inexact matches (i.e. Ofice for Office)
- `LicensesClient::DATA_KEYWORDS`: an array containing the fields to search on, and their possible values, as well as an operator to specify how to use them. This array is indexed by column name, then contains 2 keys with `LicensesClient::KEYWORDS_VALUES` containing the values and `LicensesClient::KEYWORDS_OPERATOR` containing an operator (use `LicensesClient::OPERATOR_AND`, `LicensesClient::OPERATOR_OR` or `LicensesClient::OPERATOR_BETWEEN` for the operator)
- `LicensesClient::DATA_COMPARE`: an array containing the fields to compare on, and their field to compare, as well as an operator to specify how to make compare. This array is indexed by column name, then contains 2 keys with `LicensesClient::COMPARE_FIELD` containing the column you want to compare with and `LicensesClient::COMPARE_OPERATOR` containing an operator (use `LicensesClient::OPERATOR_EQ`, `LicensesClient::OPERATOR_NEQ`, `LicensesClient::OPERATOR_GT`, `LicensesClient::OPERATOR_LT` or `LicensesClient::OPERATOR_LTE` for the operator)
- `LicensesClient::DATA_FILTERS`: an array of strings containing exact matches for individual fields (field name as key and field value as value)
- `LicensesClient::DATA_EXCLUSION_FILTERS`: an array of strings containing must not matches for individual fields (field name as key and field value as value)
- `LicensesClient::DATA_SORT`: an array of strings containing the order in which sort the data (field name as key and a `LicensesClient::SORT_*` const for the sort direction)
- `LicensesClient::DATA_HIGHLIGHT`: a boolean value, search results will contain a field giving highlights if set to `true` (defaults to `false`)

Please note that the field names must be used with the consts from the `LicenseFindFieldEnum` class.

```php
<?php

use ArrowSphere\PublicApiClient\Licenses\LicensesClient;
use ArrowSphere\PublicApiClient\Licenses\Enum\LicenseFindFieldEnum;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new LicensesClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$searchResult = $client->find([
    LicensesClient::DATA_KEYWORD   => 'microsoft 365',
    LicensesClient::DATA_KEYWORDS => [
        LicenseFindFieldEnum::LICENSE_END_DATE => [
            LicensesClient::KEYWORDS_VALUES => [
                '2021-03-01T00:00:00.000Z',
                '2021-03-31T23:59:59.000Z',
            ],
            LicensesClient::KEYWORDS_OPERATOR => LicensesClient::OPERATOR_BETWEEN,
        ]
    ],
    LicensesClient::DATA_COMPARE => [
        LicenseFindFieldEnum::LICENSE_PRICE_BUY_PRICE => [
            LicensesClient::COMPARE_FIELD => LicenseFindFieldEnum::OFFER_PRICE_BAND_PRICES_BUY,
            LicensesClient::COMPARE_OPERATOR => LicensesClient::OPERATOR_GT,  
        ]
    ],
    LicensesClient::DATA_FILTERS    => [
        LicenseFindFieldEnum::LICENSE_IS_ENABLED => true,
    ],
    LicensesClient::DATA_EXCLUSION_FILTERS    => [
        LicenseFindFieldEnum::LICENSE_WARNINGS => 'PEC ratio issue',
    ],
    LicensesClient::DATA_SORT       => [
        LicenseFindFieldEnum::LICENSE_CUSTOMER_NAME => LicensesClient::SORT_DESCENDING,
    ],
    LicensesClient::DATA_HIGHLIGHT  => true,
]);

echo $searchResult->getNbResults() . ' results were found' . PHP_EOL;
echo $searchResult->getTotalPages() . ' pages' . PHP_EOL;

$filters = $searchResult->getFilters();
foreach ($filters as $filter) {
    echo $filter->getName() . ': ' . print_r($filter->getValues(), true) . PHP_EOL;
}
    
// You can get the current page's results
$licenses = $searchResult->getLicensesForCurrentPage();
foreach ($licenses as $license) {
    echo $license->getPartnerRef() . PHP_EOL;
}

// You can also browse directly through all the results
// this will make the API call as many times as needed and traverse all the pages
$licenses = $searchResult->getLicenses();
foreach ($licenses as $license) {
    echo $license->getPartnerRef() . PHP_EOL;
}
```

The `LicensesClient::find()` method returns a `FindResult` object that allows these methods:

- `getNbResults()`: returns the total number of results for this search
- `getTotalPages()`: returns the total number of pages for this search
- `getFilters()`: returns an array of `FilterFindResult` entities (see [FilterFindResult entity](#FilterFindResult))
- `getLicensesForCurrentPage()`: returns a `Generator` and yields instances of the `LicenseOfferFindResult` entity (see [LicenseOfferFindResult entity](#LicenseOfferFindResult))
- `getLicenses()`: returns a `Generator` and yields instances of the `LicenseOfferFindResult` entity

The difference between `getLicensesForCurrentPage()` and `getLicenses()` is that `getLicensesForCurrentPage()` only shows the results for the current page, you have to perform a new `find()` passing another `$page` to get more licenses. `getLicenses()` automatically calls the API as many times as needed and yields all the licenses for the search results.

### GetConfigs endpoint

The "GetConfigs" endpoint retrieve every configurations for a specific customer's license.
This endpoint is used by xSP to get some up-to-date information pertaining to a customer's license configuration.

When calling it, it is necessary to specify desired license reference and partner reference (as previously described).

```php
<?php

use ArrowSphere\PublicApiClient\Licenses\LicensesClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new LicensesClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$configs = $client->getConfigs('XSP1234');
foreach ($configs as $config) {
    echo $config->getScope() . PHP_EOL
        . $config->getName() . PHP_EOL
        . $config->getState() . PHP_EOL . PHP_EOL;
}
```

The `LicensesClient::getConfigs()` method returns a `Generator` and yields instances of the `Config` entity.

- `getScope()`: returns the scope of this configuration
- `getName()`: returns the name of the configuration
- `getState()`: returns one of the 3 possible states which are `disabled`, `enabled` and `pending`

### UpdateConfig endpoint

The "UpdateConfig" endpoint allows creating or updating a license configuration.

It is necessary to specify desired license reference and desired configuration data.
It should be noted that endpoint will return an error (ie a not-200 result code) if it is called to update a configuration which state is 'pending'. The same will happen if an update is requested for a configuration which state is identical to the given one.

```php
<?php

use ArrowSphere\PublicApiClient\Licenses\LicensesClient;
use ArrowSphere\PublicApiClient\Licenses\Entities\License\Config;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new LicensesClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$configToUpdate = new Config([
    'name' => 'purchaseReservations',
    'scope' => 'role',
    'state' => 'enabled'
]);

$config = $client->updateConfig('XSP1234', $configToUpdate);

echo $config->getName() . ' is now ' . $config->getState() . PHP_EOL . PHP_EOL;
```

The `LicensesClient::updateConfig()` method returns a `Config` with actualized values.

- `getName()`: returns the name of the configuration
- `getState()`: returns one of the 3 possible states which are `disabled`, `enabled` and `pending`

### getPredictions endpoint

The "getPredictions" endpoint allows getting predictions for specific license .

It is necessary to specify desired license reference .
It should be noted that endpoint will return an error (ie a not-200 result code) if the predictions of the specified license is missing.

```php
<?php

use ArrowSphere\PublicApiClient\Licenses\LicensesClient;
use ArrowSphere\PublicApiClient\Licenses\Entities\License\Predictions;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new LicensesClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$predictions = $client->getPredictions('XSP1234');
```

The `LicensesClient::getPredictions()` method returns a `Predictions` with Predictions values.

- `getCurrency()`: returns the currecny  of the license and predictions.
- `getUpdatedAt()`: returns the last date the prediction machine learning script was launched .
- `getLicenseReference()`: returns the license reference .
- `getPredictionResponse()`: returns an array of predictionResponse with the date and value .

### getAwsPayerAccountList endpoint

The "getAwsPayerAccountList" endpoint allows getting the list of AWS payer accounts for a specific endCustomerRef.
it should return a list of AWS payer accounts ( 3 types available: arrow, partner, end customer) .

```php
<?php
use ArrowSphere\PublicApiClient\Licenses\LicensesClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new LicensesClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$awsPayerAccountList = $client->getAwsPayerAccountList('XSP1234');

```
