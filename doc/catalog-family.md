# Catalog Family Client

## General information
A family is group of offers, used by ArrowSphere to avoid having too many 
offers all at once if a vendor has too many of them.

The term "family" replaces the legacy term "service".

## Entity
A family is managed by the ```Family``` entity.

| Field          | Type           | Example                           | Description                      |
|----------------|----------------|-----------------------------------|----------------------------------|
| classification | ```string```   | SAAS                              | The classification of the family |
| marketplace    | ```string```   | US                                | The marketplace of the family    |
| name           | ```string```   | Office 365 Business – (Corporate) | The name of the family           |
| reference      | ```string```   | MS-0A-O365-BUSINESS               | The identifier of the family     |
| vendor         | ```string```   | Microsoft                         | The vendor of the family         |
| vendorCode     | ```string```   | microsoft                         | The vendor code of the family    |

## Usage
The family client is simply called ```FamilyClient```.
You can get it through the main entry point ```PublicApiClient``` and its method ```getFamilyClient()```, or instanciate it directly:
```php
<?php

use ArrowSphere\PublicApiClient\Catalog\FamilyClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new FamilyClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$families = $client->getFamilies('microsoft');
foreach ($families as $family) {
    echo $family->getName() . PHP_EOL;
}

$family = $client->getFamily('microsoft', 'MS-0A-O365-BUSINESS');
echo $family->getName() . PHP_EOL;
```

You can list all the families of a [program](catalog-program.md) by calling the ```getFamilies()``` method with the following parameters:
- ```string $vendorCode```: the [program](catalog-program.md) (ex. ```'microsoft'```)

This parameter is case-insensitive.

This method returns a ```Generator``` and yields instances of the ```Family``` entity.

You can also get a particular family by calling the ```getFamily()``` method with the following parameters:
- ```string $vendorCode```: the [program](catalog-program.md) (ex. ```'microsoft'```)
- ```string $reference```: the reference of the family (ex. ```'MS-0A-O365-BUSINESS'```)

Please note that the ```$reference``` parameter is case-sensitive. The other parameters are case-insensitive.
