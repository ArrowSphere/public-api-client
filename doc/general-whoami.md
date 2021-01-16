# Who Am I client

## General information
This endpoint allows the user to get information about himself.

## Entity
The endpoint is linked to the ```Whoami``` entity.

| Field             | Type           | Example                  | Description                    |
|-------------------|----------------|--------------------------|--------------------------------|
| companyName       | ```string```   | Wayne industries         | The name of the company        |
| addressLine1      | ```string```   | 1007 Mountain Drive      |                                |
| addressLine2      | ```string```   | Wayne Manor              |                                |
| zip               | ```string```   | 12345                    |                                |
| city              | ```string```   | Gotham City              |                                |
| countryCode       | ```string```   | US                       |                                |
| state             | ```string```   | NJ                       |                                |
| receptionPhone    | ```string```   | 1-800-555-1111           |                                |
| websiteUrl        | ```string```   | https://www.dccomics.com |                                |
| emailContact      | ```string```   | nobody@example.com       |                                |
| headcount         | ```string```   | null                     |                                |
| taxNumber         | ```string```   |                          |                                |
| reference         | ```string```   | XSP12345                 |                                |
| ref               | ```string```   | COMPANY12345             |                                |
| billingId         | ```string```   |                          |                                |
| internalReference | ```string```   |                          |                                |

## Usage
The "who am I" client is simply called ```WhoamiClient```.
You can get it through the main entry point ```PublicApiClient``` and its method ```getWhoamiClient()```, or instanciate it directly:
```php
<?php

use ArrowSphere\PublicApiClient\General\WhoamiClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new WhoamiClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

$whoAmI = $client->getWhoami();
echo $whoAmI->getCompanyName() . PHP_EOL;
```
