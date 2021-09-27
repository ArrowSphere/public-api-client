# Catalog Classification client

## General information

A classification is the main category of the offers.

## Entity

A service is managed by the `Classification` entity.

| Field | Type     | Example | Description                    |
| ----- | -------- | ------- | ------------------------------ |
| name  | `string` | SAAS    | The name of the classification |

## Usage

The classification client is simply called `ClassificationClient`.
You can get it through the main entry point `PublicApiClient` and its method `getClassificationClient()`, or instanciate it directly:

```php
<?php

use ArrowSphere\PublicApiClient\Catalog\ClassificationClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new ClassificationClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$classifications = $client->getClassifications();
foreach ($classifications as $classification) {
    echo $classification->getName() . PHP_EOL;
}
```

You can list all the classifications by calling the `getClassifications()` method.

This method returns a `Generator` and yields instances of the `Classification` entity.
