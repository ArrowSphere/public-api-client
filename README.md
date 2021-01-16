# ArrowSphere public-api-client package

[![Latest Stable Version](https://img.shields.io/packagist/v/arrowsphere/public-api-client)](https://packagist.org/packages/arrowsphere/public-api-client)
[![Minimum PHP Version](https://img.shields.io/packagist/php-v/arrowsphere/public-api-client)](https://img.shields.io/packagist/php-v/arrowsphere/public-api-client)
[![Build Status](https://img.shields.io/github/workflow/status/ArrowSphere/public-api-client/CI)](https://github.com/ArrowSphere/public-api-client/actions)

This package provides a PHP client for ArrowSphere's public API.
It should be the only way to make calls to ArrowSphere's API with PHP code.

To use this package, you need valid access to ArrowSphere, with a valid API key.

## Installation

Install the latest version with

```bash
$ composer require arrowsphere/public-api-client
```

## Basic usage
```php
<?php

use ArrowSphere\PublicApiClient\PublicApiClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new PublicApiClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$whoami = $client->getWhoamiClient()->getWhoami();
echo "Hello " . $whoami->getCompanyName();

```

## Specific API clients

### General clients
- [Who Am I](doc/general-whoami.md)

### Catalog clients
- [Classification](doc/catalog-classification.md)
- [Program](doc/catalog-program.md)
- [Service](doc/catalog-service.md)
- [Offer](doc/catalog-offer.md)
- [Add-on](doc/catalog-addon.md)

### Consumption clients
- [HealthCheck](doc/consumption-healthCheck.md)
- [Monthly analytics](doc/consumption-monthlyAnalytics.md)

### Licenses clients
- [Licenses](doc/licenses.md)
