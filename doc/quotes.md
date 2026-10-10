# Quotes client

## General information

The quotes client is used to request a quote for an end customer.

## Entities

### CreateQuote

A quote request is managed by the `CreateQuote` entity.

| Field         | Type       | Example   | Description                                    |
|---------------|------------|-----------|------------------------------------------------|
| customer      | `Customer` |           | The end customer, identified by its reference |
| items         | `Item[]`   |           | The products to quote                          |
| promotionCode | `string`   | Azerty123 | An optional promotion code                     |

### Item

| Field                   | Type     | Example                                  | Description                                                     |
|-------------------------|----------|------------------------------------------|-----------------------------------------------------------------|
| arrowSpherePriceBandSku | `string` | MSCSP_CFQ7TTC0LCHC-0002_FR_EUR_1_720_8640 | The price band to quote                                        |
| quantity                | `int`    | 2                                        | The quantity                                                    |
| coterminosityDate       | `string` | 2022-12-31                               | An optional coterminosity date                                  |
| prices                  | `Prices` |                                          | Optional prices for `arrow`, `partner` or `customer`, each with a `fixedPrice` or a `rate` (`rateType` and `value`) |

### CreateQuoteResponse

| Field     | Type     | Example                  | Description            |
|-----------|----------|--------------------------|------------------------|
| reference | `string` | XSPQ1345631              | The quote reference    |
| status    | `string` | In progress              | The quote status       |
| link      | `string` | /api/quotes/XSPQ1345631  | The link to the quote  |

## Usage

The quotes client is simply called `QuotesClient`.
You can get it through the main entry point `PublicApiClient` and its method `getQuotesClient()`, or instantiate it directly:

```php
<?php

use ArrowSphere\PublicApiClient\Quotes\QuotesClient;
use ArrowSphere\PublicApiClient\Quotes\Request\CreateQuote;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new QuotesClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$response = $client->create(new CreateQuote([
    'customer' => [
        'reference' => 'XSP4533',
    ],
    'items'    => [
        [
            'arrowSpherePriceBandSku' => 'MSCSP_CFQ7TTC0LCHC-0002_FR_EUR_1_720_8640',
            'quantity'                => 2,
            'prices'                  => [
                'customer' => [
                    'fixedPrice' => 10,
                ],
            ],
        ],
    ],
]));

echo $response->getReference() . ' ' . $response->getStatus() . PHP_EOL;
```

The `QuotesClient::create()` method returns a `CreateQuoteResponse` entity.
