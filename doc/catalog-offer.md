# Catalog Offer Client 

## General information
An offer is the most important data of the catalog because it's the unit of sale in ArrowSphere.

## Entities

### Offer
An offer is managed by the ```Offer``` entity.

| Field               | Type              | Example                              | Description                                                                                           |
|---------------------|-------------------|--------------------------------------|-------------------------------------------------------------------------------------------------------|
| addons              | ```string[]```    | ['123', '456']                       | An array containing the compatible add-ons for this offer                                             |
| buyingProgram       | ```string```      | Corporate                            |                                                                                                       |
| category            | ```string[]```    | ['Productivity']                     | An array of categories                                                                                |
| classification      | ```string```      | SAAS                                 | The [classification](catalog-classification.md)                                                       |
| conversionSkus      | ```string[]```    | ['123', '456']                       | An array containing the offers that this one can convert to. To be used with a trial.                 |
| customerCategory    | ```string```      | Corporate                            | A category for the customer                                                                           |
| description         | ```string```      | Some text...                         | A short text description for this offer                                                               |
| endCustomerFeatures | ```string```      | Some text...                         | A long text with HTML describing the offer's features, to be displayed to the end customers           |
| eula                | ```string```      | Some text...                         | The end-user license agreement                                                                        |
| featuresPicture     | ```string```      | https://example.com/image.png        | An image to be displayed next to the features                                                         |
| fullFeatures        | ```string```      | Some text...                         | A long text with HTML describing the offer's features, to be displayed to the resellers               |
| hasAddons           | ```bool```        | true                                 | A flag to indicate whether the offer has add-on(s) or not                                             |
| isAddon             | ```bool```        | false                                | A flag to indicate whether the offer is an add-on or not                                              |
| isEnabled           | ```bool```        | true                                 | A flag to indicate whether the offer is activated or not                                              |
| isTrial             | ```bool```        | false                                | A flag to indicate whether the offer is a trial or not                                                |
| keywords            | ```string[]```    | ['Corporate']                        | An array of keywords                                                                                  |
| marketplace         | ```string```      | US                                   | The marketplace of the catalog the offer comes from                                                   |
| name                | ```string```      | Microsoft 365 Business Standard      | The name                                                                                              |
| orderableSku        | ```string```      | U0FBU3x8bWljcm9zb2Z0fH (....)        | Another identifier of the offer, to be used in the ordering API                                       |
| prerequisites       | ```string[]```    | ['123', '456']                       | An array containing the offers compatible with this add-on. Makes sense only for add-ons.             |
| priceBands          | ```PriceBand[]``` | an array of [PriceBand](#PriceBand)  | An array of [PriceBand](#PriceBand) with calculated prices for the reseller                           |
| programIsEnabled    | ```bool```        | true                                 | A flag to indicate whether the program of the offer is enabled or not                                 |
| requirements        | ```string```      | Some text...                         | A long text with HTML describing what the reseller has to do to be allowed to purchase this offer     |
| serviceDescription  | ```string```      | Some text...                         | A short text description for the [service](catalog-service.md)                                        |
| serviceName         | ```string```      | Office 365 Business – (Corporate)    | The name of the [service](catalog-service.md)                                                         |
| serviceRef          | ```string```      | MS-0A-O365-BUSINESS                  | The identifier of the [service](catalog-service.md)                                                   |
| shortFeatures       | ```string```      | Some text...                         | A long text with HTML describing a summary of the offer's features, to be displayed to the resellers. |
| sku                 | ```string```      | 031C9E47-4802-4248-838E-778FB1D2CC05 | The sku (unique identifier for the offer)                                                             |
| thumbnail           | ```string```      | https://example.com/image.png        | The main image for the offer                                                                          |
| vendor              | ```string```      | Microsoft                            | The vendor                                                                                            |
| vendorCode          | ```string```      | microsoft                            | The [program](catalog-program.md) (the name ```vendorCode``` is confusing but it is really a program) |
| weightForced        | ```float```       | 0                                    | A numeric value to sort offers on, with offers manually entered                                       |
| weightTopSales      | ```float```       | 0                                    | A numeric value to sort offers on, calculated on the best sales for the marketplace                   |

### PriceBand
A price band is a price available for an offer under certain conditions:
- quantity (how many licenses the customer wants to purchase)
- term (for how long the customer commits himself)
- periodicity (how frequently the customer needs to pay)
- currency (in what currency the customer needs to pay)

The prices can change depending on these parameters, hence the concept of price bands.

A price band is managed by the ```PriceBand``` entity.

| Field              | Type         | Example   | Description                                                                                                                                                    |
|--------------------|--------------|-----------|----------------------------------------------------------------------------------------------------------------------------------------------------------------|
| minQuantity        | ```int```    | 1         | The minimum quantity for the price band to be valid                                                                                                            |
| maxQuantity        | ```int```    | 999       | The maximum quantity for the price band to be valid. If there's no maximum, this field takes the value ```null```                                              |
| recurringBuyPrice  | ```float```  | 12.99     | The buy price for the reseller                                                                                                                                 |
| recurringSellPrice | ```float```  | 14.99     | The list price of the offer (public price)                                                                                                                     |
| arrowPrice         | ```float```  | 9.99      | The buy price for Arrow (this field is ```null``` for non-Arrow users                                                                                          |
| term               | ```string``` | 1 Year    | For how long the customer commits himself                                                                                                                      |
| unitType           | ```string``` | LICENSE   |                                                                                                                                                                |
| recurringTimeUnit  | ```string``` | per Month | The periodicity, i.e how frequently the customer needs to pay                                                                                                  |
| currency           | ```string``` | USD       | The currency of the price band                                                                                                                                 |
| periodAsHours      | ```int```    | 720       | The periodicity, converted to hours (with a base of 30 days per month so it's not an accurate value, should be used only as a key to identify the periodicity) | 
| termAsHours        | ```int```    | 8640      | The term, converted to hours (with a base of 30 days per month so it's not an accurate value, should be used only as a key to identify the term)               |

### FilterFindResult
This entity represents a filter returned by the [Find endpoint](#Find endpoint). 
It shows a number of possible filters in the search results and the count for each of them.

| Field  | Type         | Example     | Description              |
|--------|--------------|-------------|--------------------------|
| name   | ```string``` | vendor      | The name of the filter   |
| values | ```array```  | (see below) | The values of the filter |

Each entry in the ```values``` array looks like this:

| Field | Type         | Example   | Description                                   |
|-------|--------------|-----------|-----------------------------------------------|
| value | ```string``` | Microsoft | The value of the entry                        |
| count | ```int```    | 3         | How many results are available for this entry |

The focus of these filters is to allow to display them to the user as a list of checkboxes 
with how many results are available in each of them.

### OfferFindResult
This entity represents a search result.
It is essentially a subset of the [Offer](#Offer) entity.
This entity is smaller because it only aims to display summary information about the products, not extended information.
It should be used to display search results or to make a listing of offers.

| Field            | Type              | Example                              | Description                                                                                           |
|------------------|-------------------|--------------------------------------|-------------------------------------------------------------------------------------------------------|
| addons              | ```string[]```    | ['123', '456']                       | An array containing the compatible add-ons for this offer                                             |
| category         | ```string[]```    | ['Productivity']                     | An array of categories                                                                                |
| classification   | ```string```      | SAAS                                 | The [classification](catalog-classification.md)                                                       |
| customerCategory | ```string```      | Corporate                            | A category for the customer                                                                           |
| hasAddons        | ```bool```        | true                                 | A flag to indicate whether the offer has add-on(s) or not                                             |
| highlight        | ```array```       | ['sku' => '<strong>ABC</strong>']    | An associative array which shows which values are to be highlighted based on the search keywords      |
| id               | ```string```      | 45178cd297cf6e36488a13d211243227     | An internal identifier for the offer                                                                  |
| isAddon          | ```bool```        | false                                | A flag to indicate whether the offer is an add-on or not                                              |
| isTrial          | ```bool```        | false                                | A flag to indicate whether the offer is a trial or not                                                |
| keywords         | ```string[]```    | ['Corporate']                        | An array of keywords                                                                                  |
| marketplace      | ```string```      | US                                   | The marketplace of the catalog the offer comes from                                                   |
| name             | ```string```      | Microsoft 365 Business Standard      | The name                                                                                              |
| prerequisites       | ```string[]```    | ['123', '456']                       | An array containing the offers compatible with this add-on. Makes sense only for add-ons.             |
| priceBands       | ```PriceBand[]``` | an array of [PriceBand](#PriceBand)  | An array of [PriceBand](#PriceBand) with calculated prices for the reseller                           |
| programIsEnabled | ```bool```        | true                                 | A flag to indicate whether the program of the offer is enabled or not                                 |
| serviceName      | ```string```      | Office 365 Business – (Corporate)    | The name of the [service](catalog-service.md)                                                         |
| serviceRef       | ```string```      | MS-0A-O365-BUSINESS                  | The identifier of the [service](catalog-service.md)                                                   |
| sku              | ```string```      | 031C9E47-4802-4248-838E-778FB1D2CC05 | The sku (unique identifier for the offer)                                                             |
| vendor           | ```string```      | Microsoft                            | The vendor                                                                                            |
| vendorCode       | ```string```      | microsoft                            | The [program](catalog-program.md) (the name ```vendorCode``` is confusing but it is really a program) |
| weightForced     | ```float```       | 0                                    | A numeric value to sort offers on, with offers manually entered                                       |
| weightTopSales   | ```float```       | 0                                    | A numeric value to sort offers on, calculated on the best sales for the marketplace                   |

Please note that the ```highlight``` field is only available if the ```DATA_HIGHLIGHT``` option is set to ```true``` while searching.

## Usage
The offer client is simply called ```OfferClient```.
You can get it through the main entry point ```PublicApiClient``` and its method ```getOfferClient()```, or instanciate it directly.

ArrowSphere has designed a new way to search through offers and access their details, 
to make it easier to perform searchs and display an offer's details.
This is the encouraged way to access offers in ArrowSphere. See paragraph [Find and Details endpoints](#Find and Details endpoints) 
below for the documentation.

The old way to access offers is still available, though, but the methods are marked as deprecated and are unlikely to be updated.
The documentation for the old endpoints is below, see paragraph [Legacy endpoints](#Legacy endpoints).

### Find and Details endpoints

#### Find endpoint

The "Find" endpoint has been designed specifically to perform quick and easy search through the offers of the catalog.
This is the endpoint called by xSP on its search bar and on the listing pages.

For perfomance reasons, this endpoint doesn't provide all the fields of the offers. It only returns a subset of these fields.

The postData is supposed to contain the following keys:
- ```OfferClient::DATA_KEYWORDS```: a string to be searched in all the fields. Supports inexact matches (i.e. Ofice for Office)
- ```OfferClient::DATA_FILTERS```: an array of strings containing exact matches for individual fields (field name as key and field value as value)
- ```OfferClient::DATA_SORT```: an array of strings containing the order in which sort the data (field name as key and a ```OfferClient::SORT_*``` const for the sort direction)
- ```OfferClient::DATA_HIGHLIGHT```: a boolean value, search results will contain a field giving highlights if set to ```true``` (defaults to ```false```)
- ```OfferClient::DATA_TOP_OFFERS```: search results will provide top offers if set to ```true``` (defaults to ```false```)

Please note that the field names must be used with the ```Offer::COLUMN_*``` consts from the ```Offer``` entity class.

```php
<?php

use ArrowSphere\PublicApiClient\Catalog\OfferClient;
use ArrowSphere\PublicApiClient\Catalog\Entities\Offer;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OfferClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$searchResult = $client->find([
    OfferClient::DATA_KEYWORDS   => 'microsoft 365',
    OfferClient::DATA_FILTERS    => [
        Offer::COLUMN_VENDOR => 'Microsoft',
    ],
    OfferClient::DATA_SORT       => [
        Offer::COLUMN_NAME => OfferClient::SORT_DESCENDING,
    ],
    OfferClient::DATA_HIGHLIGHT  => true,
    OfferClient::DATA_TOP_OFFERS => true,
]);

echo $searchResult->getNbResults() . ' results were found' . PHP_EOL;
echo $searchResult->getTotalPages() . ' pages' . PHP_EOL;

$topOffers = $searchResult->getTopOffers();
echo count($topOffers) . ' top offers found' . PHP_EOL;
foreach ($topOffers as $offer) {
    echo "Top offer: " . $offer->getName() . PHP_EOL;
}

$filters = $searchResult->getFilters();
foreach ($filters as $filter) {
    echo $filter->getName() . ': ' . print_r($filter->getValues(), true) . PHP_EOL;
}

// You can get the current page's results
$offers = $searchResult->getOffersForCurrentPage();
foreach ($offers as $offer) {
    echo $offer->getName() . PHP_EOL;
}

// You can also browse directly through all the results
// this will make the API call as many times as needed and traverse all the pages
$offers = $searchResult->getOffers();
foreach ($offers as $offer) {
    echo $offer->getName() . PHP_EOL;
}
```

The ```OfferClient::find()``` method returns a ```FindResult``` object that allows these methods:
- ```getNbResults()```: returns the total number of results for this search
- ```getTotalPages()```: returns the total number of pages for this search
- ```getFilters()```: returns an array of ```FilterFindResult``` entities (see [FilterFindResult entity](#FilterFindResult))
- ```getOffersForCurrentPage()```: returns a ```Generator``` and yields instances of the ```OfferFindResult``` entity (see [OfferFindResult entity](#OfferFindResult))
- ```getOffers()```: returns a ```Generator``` and yields instances of the ```OfferFindResult``` entity

The difference between ```getOffersForCurrentPage()``` and ```getOffers()``` is that ```getOffersForCurrentPage()``` only shows the results for the current page, you have to perform a new ```find()``` passing another ```$page``` to get more offers. ```getOffers()``` automatically calls the API as many times as needed and yields all the offers for the search results.

#### Details endpoint

The "Details" endpoint allows seeing detailed information about a particular offer.

```php
<?php

use ArrowSphere\PublicApiClient\Catalog\OfferClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OfferClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$offer = $client->getOfferDetails('SAAS', 'microsoft', '031C9E47-4802-4248-838E-778FB1D2CC05');
echo $offer->getName() . PHP_EOL;
```

The ```OfferClient::getOfferDetails()``` method returns an ```Offer``` entity (see [Offer entity](#Offer)).

### Legacy endpoints

```php
<?php

use ArrowSphere\PublicApiClient\Catalog\OfferClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new OfferClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$offers = $client->getOffers('SAAS', 'microsoft', 'MS-0A-O365-BUSINESS');
foreach ($offers as $offer) {
    echo $offer->getName() . PHP_EOL;
}

$offer = $client->getOffer('SAAS', 'microsoft', 'MS-0A-O365-BUSINESS', '031C9E47-4802-4248-838E-778FB1D2CC05');
echo $offer->getName() . PHP_EOL;
```

You can list all the offers of a [service](catalog-service.md) by calling the ```getOffers()``` method with the following parameters:
- ```string $classification```: the [classification](catalog-classification.md) (ex. ```'SAAS'```)
- ```string $program```: the [program](catalog-program.md) (ex. ```'microsoft'```)
- ```string $serviceRef```: the [service](catalog-service.md) (ex. ```'MS-0A-O365-BUSINESS'```)

Please note that the ```$serviceRef``` parameter is case-sensitive. The other parameters are case-insensitive.

This method returns a ```Generator``` and yields instances of the ```Offer``` entity.

You can also get a particular offer by calling the ```getOffer()``` method with the following parameters:
- ```string $classification```: the [classification](catalog-classification.md) (ex. ```'SAAS'```)
- ```string $program```: the [program](catalog-program.md) (ex. ```'microsoft'```)
- ```string $serviceRef```: the [service](catalog-service.md) (ex. ```'MS-0A-O365-BUSINESS'```)
- ```string $sku```: the sku (ex. ```'031C9E47-4802-4248-838E-778FB1D2CC05'```)

Please note that the ```$serviceRef``` and ```$sku``` parameters are case-sensitive. The other parameters are case-insensitive.
