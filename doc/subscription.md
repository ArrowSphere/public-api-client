# Subscription Client

## General information

The subscription client is used to validate subscriptions to programs.

## Entities

### Subscription

A subscription is managed by the `Subscription` entity.

| Field             | Type          | Example                | Description                                          |
|-------------------|---------------|------------------------|------------------------------------------------------|
| name              | `string`      | MSCSP                  | Program internal name                                |
| details           | `string[]`    | ['mpnid', '12345']     | The subscription details                             |
| reference         | `string`      | XSPS12345              | Subsciption reference                                |
| status            | `string`      | In Progress            | Subscription's status                                |
| dateDemand        | `string`      | 2022-07-26 14:25:17    | Date of the program subscription                     |
| dateValidation    | `string`      | 2022-07-26 14:25:17    | Date of the subscription validation                  |
| dateEnd           | `string`      | 2022-07-26 14:25:17    | Date of the send of the subscription                 |

## Usage

You can get it through the main entry point `PublicApiClient` and its method `getSubscriptionClient()`, or instantiate it directly as follows:

```php
<?php

use ArrowSphere\PublicApiClient\subscription\SubscriptionClient;

const URL = 'https://your-url-to-arrowsphere.example.com

$client = (new SubscriptionClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);


$client->validateSubscription('XSPS12345');
```