# Upgrade guide

## 0.6 to 0.7

### Changes to the campaigns client

To get an active campaign, the `CampaignsClient` class now requires the customer reference to be specified.

v0.6:
```php
<?php
use ArrowSphere\PublicApiClient\Campaigns\CampaignsClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new CampaignsClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$activeCampaign = $client->getActiveCampaign();
```

v0.7:
```php
<?php
use ArrowSphere\PublicApiClient\Campaigns\CampaignsClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new CampaignsClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$customerRef = 'XSP12345';
$activeCampaign = $client->getActiveCampaign($customerRef);
```

## 0.5 to 0.6

### Changes to the campaigns client

The `CampaignsClient` methods have been updated to follow the same pattern as the other clients, with the "raw" method returning the response from the API and the main method returning entities:
- `getCampaginAssets()` now returns an array of `Asset` entities
- `getCampaignAssetsUploadUrl()` now returns an array of `AssetUploadUrl` entities
- both these methods have a `Raw` counterpart method that returns directly the response from the API: `getCampaginAssetsRaw()` and `getCampaignAssetsUploadUrlRaw()`

## 0.4 to 0.5

### Changes to the campaigns client

The `CampaignsClient` method `getCampaigns()` now yields `Campaign` entities.
The original `getCampaigns()` method that used to return the raw response of the API has been renamed to `getCampaignsRaw()`.

## 0.3 to 0.4

No incompatible change in this version.

## 0.2 to 0.3

### Changes to the license entity
The `License` entity has been changed to reflect the arborescence of objects returned by the API, so 2 new classes have been created to handle this: `ActiveSeats` and `Price`.

The `activeSeatsNumber` and `activeSeatsLastUpdate` properties have been replaced by an `activeSeats` property that points to an instance of the `ActiveSeats` class (see [ActiveSeats entity](doc/licenses.md#ActiveSeats) documentation).

The `buyPrice`, `listPrice` and `currency` fields have been removed and replaced by a `price` property that points to an instance of the `Price` class (see [Price entity](doc/licenses.md#Price) documentation).

v0.2:
```php
<?php

use ArrowSphere\PublicApiClient\Licenses\Entities\License;

/** @var License $license */
$number = $license->getActiveSeatsNumber();
$lastUpdate = $license->getActiveSeatsLastUpdate();
$buyPrice = $license->getBuyPrice();
$listPrice = $license->getListPrice();
$currency = $license->getCurrency();
```

v0.3:
```php
<?php

use ArrowSphere\PublicApiClient\Licenses\Entities\License\License;

/** @var License $license */
$number = $license->getActiveSeats()->getNumber();
$lastUpdate = $license->getActiveSeats()->getLastUpdate();
$buyPrice = $license->getPrice()->getBuyPrice();
$listPrice = $license->getPrice()->getListPrice();
$currency = $license->getPrice()->getCurrency();
```

### Changes due to the integration of the v2 license endpoint

The fields that need to be passed as keywords, filters and sort options have been heavily changed and now need to be prefixed. To avoid making mistakes, the `LicenseFindFieldEnum` class has been created, and gives access to the complete list of fields available, already prefixed as needed.

v0.2:
```php
<?php

use ArrowSphere\PublicApiClient\Licenses\LicensesClient;
use ArrowSphere\PublicApiClient\Licenses\Entities\License;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new LicensesClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$searchResult = $client->find([
    LicensesClient::DATA_KEYWORD   => 'microsoft 365',
    LicensesClient::DATA_KEYWORDS => [
        License::COLUMN_END_DATE => [
            LicensesClient::KEYWORDS_VALUES => [
                '2021-03-01T00:00:00.000Z',
                '2021-03-31T23:59:59.000Z',
            ],
            LicensesClient::KEYWORDS_OPERATOR => LicensesClient::OPERATOR_BETWEEN,
        ]
    ],
    LicensesClient::DATA_FILTERS    => [
        License::COLUMN_IS_ENABLED => true,
    ],
    LicensesClient::DATA_SORT       => [
        License::COLUMN_CUSTOMER_NAME => LicensesClient::SORT_DESCENDING,
    ],
    LicensesClient::DATA_HIGHLIGHT  => true,
]);
```

v0.3:
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
    LicensesClient::DATA_FILTERS    => [
        LicenseFindFieldEnum::LICENSE_IS_ENABLED => true,
    ],
    LicensesClient::DATA_SORT       => [
        LicenseFindFieldEnum::LICENSE_CUSTOMER_NAME => LicensesClient::SORT_DESCENDING,
    ],
    LicensesClient::DATA_HIGHLIGHT  => true,
]);
```

## 0.1 to 0.2

The `curl/curl` dependency has been dropped and replaced by `guzzlehttp/guzzle`.

Consequently, the "client" classes no longer take a `Curl` instance in their constructors but a `ClientInterface` instance (see [PSR-18](https://www.php-fig.org/psr/psr-18/)).

The `getCurler()` method has been removed from the "client" classes.
