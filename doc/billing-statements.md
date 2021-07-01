# Billing statements client

## General information
A billing statement is a way to present your invoice. As a reseller,
use billing preferences to set how billing statements are generated.

## Entities

### Statement
The Statement entity allow to get information about the billing statement header.

| Field                           | Type              | Example                                 | Description                                      |
|---------------------------------|-------------------|-----------------------------------------|--------------------------------------------------|
| countryCurrency                 | ```string```      | USD                                     | Country Currency                                 |
| countryEndCustomerTotalBuyPrice | ```numeric```     | 42.0                                    | End Customer Total Buy Price in country currency |
| countryResellerTotalBuyPrice    | ```numeric```     | 23.1                                    | Reseller Total Buy Price in country currency     |
| creationDate                    | ```string```      | 2021-04-13                              | Date of creation                                 |
| from                            | ```Identity```    |                                         | Identity of the reseller                         |
| group                           | ```string```      | ResellerBilling                         | Billing group name                               |
| issueDate                       | ```string/null``` | 2021-04-01                              | Date of the issue                                |
| marketplace                     | ```string```      | US                                      | Country code                                     |
| reference                       | ```string```      | H1-AAA-0123456789ABCDEF0123456789ABCDEF | Identifier of the statement                      |
| status                          | ```string```      | Open                                    | ```Open```, ```In Progress``` or ```Fulfilled``` |
| strategy                        | ```string```      |                                         | Billing strategy name                            |
| submissionDate                  | ```string/null``` | 2021-04-01                              | Date of the submission                           |
| to                              | ```Identity[]```  |                                         | Identities of customers                          |
| vendorCurrency                  | ```string```      | EUR                                     | Vendor Currency                                  |
| vendorEndCustomerTotalBuyPrice  | ```numeric```     | 42.0                                    | End Customer Total Buy Price in vendor currency  |
| vendorResellerTotalBuyPrice     | ```numeric```     | 23.1                                    | Reseller Total Buy Price in vendor currency      |

### Identity
The Identity entity allow to store reference and name about a reseller or a customer.

| Field          | Type         | Example      | Description |
|----------------|--------------|--------------|-------------|
| name           | ```string``` | Reseller 123 |             |
| reference      | ```string``` | XSP123       |             |

### StatementLine
The StatementLine entity allow to get information about a billing statement line.

| Field                           | Type              | Example                                 | Description                                      |
|---------------------------------|-------------------|-----------------------------------------|--------------------------------------------------|
| arrowSku                        | ```string```      |                                         |                                                  |
| arsSubscriptionId               | ```string/null``` | XSP123                                  |                                                  |
| billingPeriodEnd                | ```string/null``` | 2021-02-01                              |                                                  |
| billingPeriodStart              | ```string/null``` | 2021-01-01                              |                                                  |
| billingPeriodicity              | ```string/null``` | Monthly                                 | Monthly or Yearly                                |
| countryCurrency                 | ```string```      | EUR                                     |                                                  |
| countryEndCustomerTotalBuyPrice | ```string```      | 42.0                                    |                                                  |
| countryEndCustomerUnitBuyPrice  | ```string/null``` | 21.0                                    |                                                  |
| countryResellerTotalBuyPrice    | ```string```      | 42.0                                    |                                                  |
| countryResellerUnitBuyPrice     | ```string/null``` | 21.0                                    |                                                  |
| countryRetailTotalBuyPrice      | ```string```      | 42.0                                    |                                                  |
| countryRetailUnitBuyPrice       | ```string/null``` | 21.0                                    |                                                  |
| endCustomerRate                 | ```string/null``` | 0.2                                     |                                                  |
| endCustomerRateType             | ```string/null``` | uplift                                  | uplift or discount                               |
| exchangeRate                    | ```string/null``` | 1.1                                     |                                                  |
| offerName                       | ```string/null``` | Offer Name                              |                                                  |
| orderId                         | ```string/null``` |                                         |                                                  |
| quantity                        | ```string/null``` | 2.0                                     |                                                  |
| reference                       | ```string```      | L1-AAA-0123456789ABCDEF0123456789ABCDEF |                                                  |
| resellerBillingTag              | ```string/null``` |                                         |                                                  |
| resellerOrderId                 | ```string/null``` |                                         |                                                  |
| serviceCode                     | ```string/null``` |                                         |                                                  |
| subscriptionEndDate             | ```string/null``` | 2021-12-01                              |                                                  |
| subscriptionFriendlyName        | ```string/null``` |                                         |                                                  |
| subscriptionStartDate           | ```string/null``` | 2020-12-01                              |                                                  |
| usageEndDate                    | ```string```      | 2021-04-17                              |                                                  |
| usageStartDate                  | ```string```      | 2021-04-02                              |                                                  |
| vendorCurrency                  | ```string/null``` | EUR                                     |                                                  |
| vendorEndCustomerSubscriptionId | ```string/null``` |                                         |                                                  |
| vendorEndCustomerTotalBuyPrice  | ```string```      | 42.0                                    |                                                  |
| vendorEndCustomerUnitBuyPrice   | ```string/null``` | 21.0                                    |                                                  |
| vendorName                      | ```string/null``` | Microsoft                               |                                                  |
| vendorProductName               | ```string/null``` | Microsoft Product                       |                                                  |
| vendorProgram                   | ```string/null``` | Vendor Program                          |                                                  |
| vendorProgramClassification     | ```string/null``` |                                         |                                                  |
| vendorResellerTotalBuyPrice     | ```string```      | 42.0                                    |                                                  |
| vendorResellerUnitBuyPrice      | ```string/null``` | 21.0                                    |                                                  |
| vendorRetailTotalBuyPrice       | ```string```      | 42.0                                    |                                                  |
| vendorRetailUnitBuyPrice        | ```string/null``` | 21.0                                    |                                                  |
| vendorSku                       | ```string/null``` |                                         |                                                  |
| description                     | ```string/null``` | Description                             | Line-specific description                        |

## Usage

### Initialization
The "billing statements" client is simply called ```StatementsClient```.
You can get it through the main entry point ```PublicApiClient``` and its method ```getBillingStatementsClient()```, or instanciate it directly:
```php
<?php

use ArrowSphere\PublicApiClient\Billing\StatementsClient;

const URL = 'https://your-url-to-arrowsphere.example.com';
const API_KEY = 'your API key in ArrowSphere';

$client = (new StatementsClient())
    ->setUrl(URL)
    ->setApiKey(API_KEY);

```

### List all the statements
You can list all the statements by calling the ```getStatements()``` method.

This method returns a ```Generator``` and yields instances of the ```Statement``` entity.

Example:
```php
<?php

$periodFrom = '2021-01';
$periodTo = '2021-03';
$statements = $client->getStatements($periodFrom, $periodTo);
foreach ($statements as $statement) {
    echo $statement->getReference() . PHP_EOL;
}
```

### Get a specific statement
You can get a specicif statement by calling the ```getStatement()``` method.

This method returns an instance of the ```Statement``` entity.

Example:

```php
<?php

$statementReference = 'H1-AAA-0123456789ABCDEF0123456789ABCDEF';
$statement = $client->getStatement($statementReference);

echo $statement->getReference() . ': ' . $statement->getStatus() . PHP_EOL;
```

### List the lines of a statement
You can list all the lines of a statement by calling the ```getStatementLines()``` method.

This method returns a ```Generator``` and yields instances of the ```StatementLine``` entity.

Example:
```php
<?php

$statementReference = 'H1-AAA-0123456789ABCDEF0123456789ABCDEF';
$statementLines = $client->getStatementLines($statementReference);
foreach ($statementLines as $statementLine) {
    echo $statementLine->getReference() . PHP_EOL;
}
```
