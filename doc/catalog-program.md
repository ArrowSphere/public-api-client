# Catalog Program Client 

## General information
A program is a specific set of offers of a vendor.

Please note that it's technically possible for a vendor to provide multiple programs.

## Entity
A program is managed by the ```Program``` entity.

| Field                         | Type           | Example                               | Description                                 |
|-------------------------------|----------------|---------------------------------------|---------------------------------------------|
| associatedSubscriptionProgram | ```string```   | MSCSP                                 | The program to which this program is linked |
| classification                | ```string```   | SAAS                                  | The classification of the program           |
| logo                          | ```string```   | /index.php/site/img/type/vendor/ref/3 | An url for the image (specific to xSP)      |
| name                          | ```string```   | Microsoft                             | The name of the program                     |
| reference                     | ```string```   | microsoft                             | The identifier of the program               |

## Usage
The program client is simply called ```ProgramClient```.
You can get it through the main entry point ```PublicApiClient``` and its method ```getProgramClient()```, or instanciate it directly:
```php
<?php

use ArrowSphere\PublicApiClient\Catalog\ProgramClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new ProgramClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$programs = $client->getPrograms('SAAS');
foreach ($programs as $program) {
    echo $program->getName() . PHP_EOL;
}

$program = $client->getProgram('SAAS', 'microsoft');
echo $program->getName() . PHP_EOL;
```

You can list all the programs of a [classification](catalog-classification.md) by calling the ```getPrograms()``` method with the following parameters:
- ```string $classification```: the [classification](catalog-classification.md) (ex. ```'SAAS'```)

This parameter is case-insensitive.

This method returns a ```Generator``` and yields instances of the ```Program``` entity.

You can also get a particular program by calling the ```getProgram()``` method with the following parameters:
- ```string $classification```: the [classification](catalog-classification.md) (ex. ```'SAAS'```)
- ```string $program```: the program (ex. ```'microsoft'```)

These parameters are case-insensitive.
