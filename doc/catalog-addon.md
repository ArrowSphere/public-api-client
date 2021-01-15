# Catalog Add-on Client 

## General information
An add-on is an offer that cannot be purchased alone, it has to be attached to a compatible offer.

## Entity
An add-on is managed by the ```Offer``` entity. See the [Offer documentation](catalog-offer.md#Offer) for more information.

## Usage

```php
<?php

use ArrowSphere\PublicApiClient\Catalog\AddonClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new AddonClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$addons = $client->getAddons(
    'SAAS',
    'microsoft',
    'MS-0A-O365-BUSINESS',
    '031C9E47-4802-4248-838E-778FB1D2CC05'
);
foreach ($addons as $addon) {
    echo $addon->getName() . PHP_EOL;
}

$addon = $client->getAddon(
    'SAAS',
    'microsoft',
    'MS-0A-O365-BUSINESS',
    '031C9E47-4802-4248-838E-778FB1D2CC05',
    '0AA62437-B86A-48BD-AE51-85C8DCEC5E6D'
);
echo $addon->getName() . PHP_EOL;
```

You can list all the add-ons of an [offer](catalog-offer.md) by calling the ```getAddons()``` method with the following parameters:
- ```string $classification```: the [classification](catalog-classification.md) (ex. ```'SAAS'```)
- ```string $program```: the [program](catalog-program.md) (ex. ```'microsoft'```)
- ```string $serviceRef```: the [service](catalog-service.md) (ex. ```'MS-0A-O365-BUSINESS'```)
- ```string $sku```: the SKU of the [offer](catalog-offer.md) (ex. ```'031C9E47-4802-4248-838E-778FB1D2CC05'```)

Please note that the ```$serviceRef``` and ```$sku``` parameters are case-sensitive. The other parameters are case-insensitive.

This method returns a ```Generator``` and yields instances of the ```Offer``` entity.

You can also get a particular add-on by calling the ```getAddon()``` method with the following parameters:
- ```string $classification```: the [classification](catalog-classification.md) (ex. ```'SAAS'```)
- ```string $program```: the [program](catalog-program.md) (ex. ```'microsoft'```)
- ```string $serviceRef```: the [service](catalog-service.md) (ex. ```'MS-0A-O365-BUSINESS'```)
- ```string $sku```: the SKU of the [offer](catalog-offer.md) (ex. ```'031C9E47-4802-4248-838E-778FB1D2CC05'```)
- ```string $addonSku```: the SKU of the add-on (ex. ```'0AA62437-B86A-48BD-AE51-85C8DCEC5E6D'```)

Please note that the ```$serviceRef```, ```$sku``` and ```$addonSku``` parameters are case-sensitive. The other parameters are case-insensitive.
