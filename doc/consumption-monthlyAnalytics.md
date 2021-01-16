# Consumption Analytics Monthly 

## General information
This endpoint allowed everyone to a summary of their consumption splited by Vendor / MarketPlace / classification for a dedicated month. 
The granularity of this endpoint based on the following attributes :
- Month formated : YYYY-MM (2020-05) 
- [MarketPlace](general-marketPlace.md) (US / CA / FR etc)
- Vendor (Microsoft / IBM etc)
- [Classification](catalog-classification.md) (IAAS / SAAS)
- Tag, filter data on a specific tag (Pax8 / TELENOR etc)

## Entity
A Monthly analytics item is managed by the ```MonthlyAnalyticsItem``` entity.

| Field            | Type                     | Example     | Description                                                     |
|------------------|--------------------------|-------------|-----------------------------------------------------------------|
| marketPlace      | ```string```             | FR          | The marketPlace attached to this split                          |
| vendor           | ```string```             | Microsoft   | The vendor attached to this split                               |
| classification   | ```string```             | SAAS        | The classification attached of this split                       |
| tag              | ```string/null```        | Pax8        | The tag attached of this split                                  |
| month            | ```string```             | 2020-05     | The month attached of this split                                |
| localPrice       | ```PriceAnalyticsItem``` |             | The localPrice item attached of this split, in local currency   |
| usdPrice         | ```PriceAnalyticsItem``` |             | The usdPrice localPrice attached of this split, in usd currency |

Description of ```PriceAnalyticsItem```

| Field            | Type               | Example     | Description                                                 |
|------------------|--------------------|-------------|-------------------------------------------------------------|
| resellerBuyPrice | ```float```        | 1367.67     | The reseller buy price                                      |
| arrowBuyPrice    | ```float/null```   | 134.34      | The arrow buy price, can be null if it is call by an MSP    |
| currency         | ```string```       | EUR         | The currency attached to the arrow and reseller price       |

## Usage

```php
<?php

use ArrowSphere\PublicApiClient\Consumption\AnalyticsClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new AnalyticsClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$items = $client->getMonthly('2020-05', ['SAAS'], ['Microsoft'], ['US'], 'Pax8');

foreach ($items as $item) {
    echo $item->getVendor() . '->' . $item->getLocalPrice()->getResellerBuyPrice() . PHP_EOL;
}

```

You can get montly analytics item by calling the ```getMonthly()``` method with the following parameters:
- ```string $month```: The dedicated month of the consumption (ex. ```'2020-05'```)
- ```array $classification```: the [classification](catalog-classification.md) (ex. ```'SAAS'```)
- ```array $vendor```: (ex. ```'microsoft'```)
- ```array $marketPlace```: the [MarketPlace](general-marketPlace.md) (ex. ```'FR'```)
- ```string $tag```: The filter tag (ex. ```'Pax8'```)

Please note that all parameters are case-insensitive.

This method will return an array with all the monthly Analytics array filter with parameters.
