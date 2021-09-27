# Consumption HealthCheck Client

## General information

This endpoint allowed everyone to know if the consumption data are accurate or not. The consumption is link to the daily accuracy of consumption vendor API.
The granularity of this endpoint based on 3 attributes :

- [MarketPlace](general-marketplace.md) (US / CA / FR etc)
- Vendor (Microsoft / IBM etc)
- [Classification](catalog-classification.md) (IAAS / SAAS)

## Entity

A HealthCheck item is managed by the `HealthCheckItem` entity.

| Field          | Type     | Example   | Description                                                                 |
| -------------- | -------- | --------- | --------------------------------------------------------------------------- |
| marketPlace    | `string` | FR        | The marketPlace attached to this healthCheck                                |
| vendor         | `string` | Microsoft | The vendor attached to this healthCheck                                     |
| color          | `string` | green     | `green` everything is ok, `yellow` minor issue, `red` data are not accurate |
| message        | `string` | OK        | Message human readable                                                      |
| classification | `string` | SAAS      | The classification attached of this healthCheck                             |

## Usage

```php
<?php

use ArrowSphere\PublicApiClient\Consumption\HealthCheckClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new HealthCheckClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$items = $client->getItem(['SAAS'], ['Microsoft'], ['FR']);

foreach ($items as $item) {
    echo $item->getVendor() . '->' . $item->getColor() . PHP_EOL;
}
```

You can get consumption healthCheck item by calling the `getItem()` method with the following parameters:

- `array $classification`: the [classification](catalog-classification.md) (ex. `'SAAS'`)
- `array $vendor`: (ex. `'microsoft'`)
- `array $marketPlace`: the [MarketPlace](general-marketPlace.md) (ex. `'FR'`)

Please note that all parameters are case-insensitive.

This method will return an array with all the consumption healthcheck item filter with parameters.
