# Subscriptions client

## General information

The information below aims to manage the subscriptions. This is how you list and manage them.

## Entities

### Subscription

An Subscription is managed by the `Subscription` entity.

| Field         | Type           | Example                | Description                |
|---------------|----------------|------------------------|----------------------------|
| reference     | `string`       | XSPS9853               | Subscription reference ID  |
| status        | `string`       | Pending                | Dtatus                     |
| dateDemand    | `string`       | 2020-01-01T00:00:00.000Z | Date demand                |
| dateValidation | `string`       | 2020-02-01T00:00:00.000Z | Date of validation         |
| dateEnd       | `string`       | 2020-03-01T00:00:00.000Z | Date end                   |
| name          | `string`       | MSCSP                  | Program name               |
| Details       | `SubscriptionDetails`       |                        | Subscription Details       |

### SubscriptionDetails

The `SubscriptionDetails` entity allows to manage the Subscription specific information:

| Field            | Type     | Example | Description                                              |
|------------------| -------- |---------| -------------------------------------------------------- |
| sales_guid       | `string` | guid    |                         |
| admin_guid       | `string` | guid    |                                              |
| helpdesk_guid    | `string` | guid    |                                 |
| mpnid            | `string`   | Id      |  |
| tenantid         | `string` | ID      |                                     |

## Usage

### Initialization

The "Subscriptions" client is simply called `SubscriptionsClient`.
You can get it through the main entry point `PublicApiClient` and its method `getSubscriptionsClient()`, or instanciate it directly:

```php
<?php

use ArrowSphere\PublicApiClient\Subscription\SubscriptionsClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new SubscriptionsClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);
```

### List all the subscriptions

You can list all the subscriptions by calling the `getSubscriptions()` method.

This method returns a `Generator` and yields instances of the `Subscription` entity.

Example:

```php
<?php

$subscriptions = $client->getSubscriptions();
foreach ($subscriptions as $subscription) {
    echo $subscription->getName() . PHP_EOL;
}
```

### Create a subscription

You can create a subscription by calling the `createSubscription()` method.

This method returns the reference of the newly created subscription.

Example:

```php
<?php

use ArrowSphere\PublicApiClient\Subscription\Entities\Subscription;

$subscription = new Subscription([
    Subscription::COLUMN_NAME     => 'MSCSP',
]);

$reference = $client->createSubscription($subscription);

echo "New subscription's reference is: " . $reference . PHP_EOL;
```
