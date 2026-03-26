# Reports Client

## General information

A report is an entity that holds information about a batch of orders to be created from an uploaded file.
A report is identified in ArrowSphere Cloud by its _report reference_, which is typically 'XSPR' followed by a few
digits (e.g. XSPR12345).

The reports client currently supports validating a report, which triggers the creation of orders from the report's
contents.

## Entities

### ValidateReportResult

The result of a report validation is managed by the `ValidateReportResult` entity.
It contains the list of orders that were created from the report.

| Field  | Type                                             | Example                                      | Description                          |
|--------|--------------------------------------------------|----------------------------------------------|--------------------------------------|
| orders | `ValidateReportOrder[]` | List of [ValidateReportOrder](#ValidateReportOrder) | The list of orders created from the report |

### ValidateReportOrder

Each order created from the report validation is managed by the `ValidateReportOrder` entity.

| Field     | Type     | Example                      | Description                          |
|-----------|----------|------------------------------|--------------------------------------|
| reference | `string` | XSPO123                     | The reference of the created order   |
| link      | `string` | api/orderSoftware/XSPO1234  | The API link to the created order    |
| status    | `string` | In progress                  | The current status of the order      |

## Usage

The reports client is simply called `ReportsClient`.
You can get it through the main entry point `PublicApiClient` and its method `getReportsClient()`, or instantiate it directly.

### validateReport endpoint

The "validateReport" method validates a report and triggers order creation through the `PublicAPI` endpoint
(PATCH /reports/{reportReference}).
The function accepts one parameter: the report reference.
The output is a `ValidateReportResult` containing the list of created orders.

```php
<?php

use ArrowSphere\PublicApiClient\Reports\ReportsClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new ReportsClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$result = $client->validateReport('XSPR12345');

foreach ($result->getOrders() as $order) {
    echo $order->getReference() . PHP_EOL;
    echo $order->getLink() . PHP_EOL;
    echo $order->getStatus() . PHP_EOL;
}
```

The `ReportsClient::validateReport()` method returns a `ValidateReportResult` entity with the following getter:

- `getOrders()` - Returns an array of `ValidateReportOrder` entities

Each `ValidateReportOrder` entity has the following getters:

- `getReference()` - The order reference (e.g. "XSPO123")
- `getLink()` - The API link to the order
- `getStatus()` - The current status of the order

A raw version of this method is also available as `validateReportRaw()`, which returns the raw JSON response as a string.
