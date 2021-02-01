# Catalog Service Client 

## Deprecated
This client is deprecated, and the associated endpoints are deprecated. You should use the [families](catalog-family.md) instead.

## General information
A service is group of offers, used by ArrowSphere to avoid having too many 
offers all at once if a vendor has too many of them.

## Entity
A service is managed by the ```Service``` entity.

| Field                             | Type           | Example                           | Description                                                   |
|-----------------------------------|----------------|-----------------------------------|---------------------------------------------------------------|
| associatedSubscriptionProgram     | ```string```   | MSCSP                             | The program to which this service is linked                   |
| classification                    | ```string```   | SAAS                              | The classification of the service                             |
| description                       | ```string```   | A text description                | A text describing what the service is                         |
| name                              | ```string```   | Office 365 Business – (Corporate) | The name of the service                                       |
| program                           | ```string```   | Microsoft                         | The name of the [program](catalog-program.md) of this service |
| reference                         | ```string```   | MS-0A-O365-BUSINESS               | The identifier of the service                                 |
| serviceTags                       | ```string[]``` | ["Productivity"]                  | An array of tags to describe the service                      |

## Usage
The service client is simply called ```ServiceClient```.
You can get it through the main entry point ```PublicApiClient``` and its method ```getServiceClient()```, or instanciate it directly:
```php
<?php

use ArrowSphere\PublicApiClient\Catalog\ServiceClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new ServiceClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$services = $client->getServices('SAAS', 'microsoft');
foreach ($services as $service) {
    echo $service->getName() . PHP_EOL;
}

$service = $client->getService('SAAS', 'microsoft', 'MS-0A-O365-BUSINESS');
echo $service->getName() . PHP_EOL;
```

You can list all the services of a [program](catalog-program.md) by calling the ```getServices()``` method with the following parameters:
- ```string $classification```: the [classification](catalog-classification.md) (ex. ```'SAAS'```)
- ```string $program```: the [program](catalog-program.md) (ex. ```'microsoft'```)

These parameters are case-insensitive.

This method returns a ```Generator``` and yields instances of the ```Service``` entity.

You can also get a particular service by calling the ```getService()``` method with the following parameters:
- ```string $classification```: the [classification](catalog-classification.md) (ex. ```'SAAS'```)
- ```string $program```: the [program](catalog-program.md) (ex. ```'microsoft'```)
- ```string $serviceRef```: the service (ex. ```'MS-0A-O365-BUSINESS'```)

Please note that the ```$serviceRef``` parameter is case-sensitive.
